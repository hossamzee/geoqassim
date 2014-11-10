<?php

class UsersController extends \BaseController {

    public function index()
    {
        return View::make('users.admin.index')
            ->with('users', User::orderBy('created_at', 'DESC')->get());
    }

    public function create()
    {
        // Get the roles and members.
        $roles = User::$roles;
        $members = [-1 => 'بدون'];

        foreach (Member::all() as $member)
        {
            $members[$member->id] = $member->name;
        }

        return View::make('users.admin.create')->with('roles', $roles)->with('members', $members);
    }

    public function store()
    {
        // Validate and all.
        $username = Input::get('username');
        $role = Input::get('role');
        $member_id = Input::get('member_id');

        // Set the roles as a string.
        $roles_as_string = implode(',', array_keys(User::$roles));

        $validator = Validator::make([
            'username' => $username,
            'role' => $role,
            'member_id' => $member_id,
        ], [
            'username' => 'required',
            'role' => 'required|in:' . $roles_as_string,
            'member_id' => 'numeric',
        ]);

        if ($validator->fails())
        {
            // Update the error language to be in Arabic.
            return Redirect::back()->withInput()->with('error_message', 'الرجاء تعبئة الحقول بشكل صحيح.');
        }

        if ($member_id == -1)
        {
            $member_id = null;
        }

        // Generate a new random password.
        $password = Str::random(20);

        // Create a new member table record.
        try
        {
            // Save the user into the database.
            $user = new User();
            $user->member_id = $member_id;
            $user->username = $username;
            $user->password = Hash::make($password);
            $user->role = $role;
            $user->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        // Get the created user.
        if ($user->member && $user->member->email)
        {
            //
            $to = $user->member->email;

            //
            $data = [
                'subject' => 'بيانات عضويتك',
                'from' => Config::get('mail.from.address'),
                'name' => 'قسم الجغرافيا في جامعة القصيم',
                'content' => 'السلام عليكم، عضويتك في موقع قسم جامعة القصيم، اسم المستخدم ' . $username . 'و كلمة المرور ' . $password,
            ];

            // Make sure this email has been sent.
            // TODO: This should be queued rather than taking a time and then response to the user.

            Mail::send('emails.contact', $data, function($message) use ($to, $data) {
                $message->from($data['from'], $data['name'])
                        ->to($to)
                        ->subject('موقع قسم الجغرافيا بجامعة القصيم - '. $data['subject']);
            });

            return Redirect::route("admin_users_index")->with('success_message', 'تمّ إضافة المستخدم بنجاح و إرسال كلمة المرور إلى بريده الإلكتروني.');
        }

        return Redirect::route("admin_users_index")->with('success_message', 'تمّ إضافة المستخدم بنجاح.')->with('info_message', 'كلمة المرور ' . $password);
    }

    public function getChangePassword()
    {
        return View::make('users.changepassword');
    }

    public function postChangePassword()
    {
        $user = Auth::user();

        if (!$user)
        {
            return Redirect::home()->with('error_message', 'لا يمكنك تغيير كلمة المرور دون تسجيل الدخول.');
        }

        //
        $current_password = Input::get('current_password');
        $new_password = Input::get('new_password');

        $validator = Validator::make([
            'current_password' => $current_password,
            'new_password' => $new_password,
        ], [
            'current_password' => 'required',
            'new_password' => 'required|different:current_password',
        ]);

        if ($validator->fails())
        {
            // Update the error language to be in Arabic.
            return Redirect::back()->withInput()->with('error_message', 'الرجاء تعبئة الحقول بشكل صحيح.');
        }

        if (!Hash::check($current_password, Auth::user()->getAuthPassword()))
        {
            return Redirect::back()->withInput()->with('error_message', 'الرجاء التأكد من إدخال كلمة مرور صحيحة.');
        }

        $user->password = Hash::make($new_password);
        $user->save();

        return Redirect::home()->with('success_message', 'تمّ تغيير كلمة المرور بنجاح.');
    }

    public function edit($id)
    {
        // TODO: Has to be an admin.

        $user = User::find($id);

        if (!$user)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف مستخدم صحيح.');
        }

        // Get the roles and members.
        $roles = User::$roles;
        $members = [-1 => 'بدون'];

        foreach (Member::all() as $member)
        {
            $members[$member->id] = $member->name;
        }

        // Get the roles that could be assigned to a member.
        $roles = User::$roles;
        return View::make('users.admin.edit')->with('user', $user)->with('roles', $roles)->with('members', $members);
    }

    public function update($id)
    {
        // TODO: Has to be an admin.

        $user = User::find($id);

        if (!$user)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف مستخدم صحيح.');
        }

        // Validate and all.
        $username = Input::get('username');
        $role = Input::get('role');
        $member_id = Input::get('member_id');

        // Set the roles as a string.
        $roles_as_string = implode(',', array_keys(User::$roles));

        $validator = Validator::make([
            'username' => $username,
            'role' => $role,
            'member_id' => $member_id,
        ], [
            'username' => 'required',
            'role' => 'required|in:' . $roles_as_string,
            'member_id' => 'numeric',
        ]);

        if ($validator->fails())
        {
            // Update the message to be an appropriate one.
            return Redirect::back()->withInput()->with('error_message', 'الرجاء تعبئة الحقول بشكل صحيح.');
        }

        if ($member_id == -1)
        {
            $member_id = null;
        }

        // Update the current member.
        try
        {
            $user->member_id = $member_id;
            $user->username = $username;
            $user->role = $role;
            $user->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_users_index')->with('success_message', 'تمّ تحديث المستخدم بنجاح.');
    }

    public function destroy($id)
    {
        // TODO: Has to be an admin.
        $user = User::find($id);

        if (!$user)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف مستخدم صحيح.');
        }

        // Check if the delete process has been done.
        try
        {
            $user->delete();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_users_index')->with('warning_message', 'تمّ حذف المستخدم بنجاح.');
    }

    public function getLogin()
    {
        if (!Auth::guest())
        {
            return Redirect::home()->with('error_message', 'لا يمكنك تسجيل الدخول مرّة أخرى.');
        }

        // TODO: Check if the user logged in, then, there is no need to show the form.
        return View::make('users.login');
    }

    public function postLogin()
    {
        // Validate and all.
        $username = Input::get('username');
        $password = Input::get('password');

        $validator = Validator::make([
            'username' => $username,
            'password' => $password,
        ], [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails())
        {
            // Update the error language to be in Arabic.
            return Redirect::back()->withInput()->with('error_message', 'اسم المستخدم أو كلمة المرور غير صحيحة.');
        }

        if (Auth::attempt(['username' => $username, 'password' => $password], true))
        {
            // TODO: This should go to the admin homepage.
            return Redirect::intended('admin')->with('success_message', 'تمّ تسجيل الدخول بنجاح.');
        }
        else
        {
            return Redirect::home()->with('error_message', 'اسم المستخدم أو كلمة المرور غير صحيحة.');
        }
    }

    public function logout()
    {
        // Logout the user.
        Auth::logout();

        // Redirect the user back home.
        return Redirect::home()->with('success_message', 'تمّ تسجيل الخروج بنجاح.');
    }
}
