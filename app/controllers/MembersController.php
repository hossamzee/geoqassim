<?php

class MembersController extends \BaseController {

    public function index()
    {
        // Get the members.
        $members = Member::orderBy('position', 'DESC')->get();
        return View::make('members.index')->with('members', $members);
    }

    public function adminIndex()
    {
        return View::make('members.admin.index')
            ->with('members', Member::orderBy('position', 'DESC')->get());
    }

    public function create()
    {
        // Get the roles that could be assigned to a member.
        $roles = Member::$roles;
        return View::make('members.admin.create')->with('roles', $roles);
    }

    public function store()
    {
        // Validate and all.
        $name = Input::get('name');
        $role = Input::get('role');
        $bio = Input::get('bio');
        $cv = Input::get('cv');
        $photo = Input::file('photo');
        $email = Input::get('email');
        $twitter_account = Input::get('twitter_account');
        $linkedin_account = Input::get('linkedin_account');

        // Set the roles as a string.
        $roles_as_string = implode(',', array_keys(Member::$roles));

        $validator = Validator::make([
            'name' => $name,
            'role' => $role,
            'bio' => $bio,
            'cv' => $cv,
            'photo' => $photo,
            'email' => $email,
        ], [
            'name' => 'required',
            'role' => 'required|in:' . $roles_as_string,
            'bio' => 'required',
            'cv' => 'required',
            'photo' => 'image',
            'email' => 'email',
        ]);

        if ($validator->fails())
        {
            // Update the error language to be in Arabic.
            return Redirect::back()->withInput()->with('error_message', 'الرجاء تعبئة الحقول بشكل صحيح.');
        }

        // Create a new member table record.
        try
        {
            // After everything, save the member into the database.
            $member = new Member();
            $member->name = $name;
            $member->role = $role;
            $member->bio = $bio;
            $member->cv = $cv;
            $member->email = $email;
            $member->twitter_account = $twitter_account;
            $member->linkedin_account = $linkedin_account;

            if ($photo)
            {
                // Create a new photo, or upload it.
                $photo_name = Str::random(40) . '.png';

                // Make the thumb photo secondly.
                $thumb_photo = Image::make($photo->getRealPath());

                $thumb_photo->widen(Member::PHOTO_WIDTH, function ($constraint) {
                  $constraint->upsize();
                });

                $thumb_photo->save(public_path() . '/photos/thumb/' . $photo_name);

                $thumb_photo_url = url('/photos/thumb/' . $photo_name);
                $member->photo_url = $thumb_photo_url;
            }

            $member->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route("admin_members_index")->with('success_message', 'تمّ إضافة العضو بنجاح.');
    }

    public function show($id)
    {
        $member = Member::find($id);

        if (!$member)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف عضو صحيح.');
        }

        return View::make('members.show')->with('member', $member);
    }

    public function edit($id)
    {
        $member = Member::find($id);

        if (!$member)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف عضو صحيح.');
        }

        // Get the roles that could be assigned to a member.
        $roles = Member::$roles;
        return View::make('members.admin.edit')->with('member', $member)->with('roles', $roles);
    }

    public function update($id)
    {
        $member = Member::find($id);

        if (!$member)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف عضو صحيح.');
        }

        // Validate and all.
        $name = Input::get('name');
        $role = Input::get('role');
        $bio = Input::get('bio');
        $cv = Input::get('cv');
        $photo = Input::file('photo');
        $email = Input::get('email');
        $twitter_account = Input::get('twitter_account');
        $linkedin_account = Input::get('linkedin_account');

        // Set the roles as a string.
        $roles_as_string = implode(',', array_keys(Member::$roles));

        $validator = Validator::make([
            'name' => $name,
            'role' => $role,
            'bio' => $bio,
            'cv' => $cv,
            'photo' => $photo,
            'email' => $email,
        ], [
            'name' => 'required',
            'role' => 'required|in:' . $roles_as_string,
            'bio' => 'required',
            'cv' => 'required',
            'photo' => 'image',
            'email' => 'email',
        ]);

        if ($validator->fails())
        {
            // Update the message to be an appropriate one.
            return Redirect::back()->withInput()->with('error_message', 'الرجاء تعبئة الحقول بشكل صحيح.');
        }

        // Update the current member.
        try
        {
            if ($photo)
            {
                // Create a new photo, or upload it.
                $photo_name = Str::random(40) . '.png';

                // Make the thumb photo secondly.
                $thumb_photo = Image::make($photo->getRealPath());

                $thumb_photo->widen(Member::PHOTO_WIDTH, function ($constraint) {
                  $constraint->upsize();
                });

                $thumb_photo->save(public_path() . '/photos/thumb/' . $photo_name);

                $thumb_photo_url = url('/photos/thumb/' . $photo_name);

                // Update the URL in the database.
                $member->photo_url = $thumb_photo_url;
            }

            $member->name = $name;
            $member->role = $role;
            $member->bio = $bio;
            $member->cv = $cv;
            $member->email = $email;
            $member->twitter_account = $twitter_account;
            $member->linkedin_account = $linkedin_account;
            $member->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_members_index')->with('success_message', 'تمّ تحديث العضو بنجاح.');
    }

    public function destroy($id)
    {
        $member = Member::find($id);

        if (!$member)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف عضو صحيح.');
        }

        // Check if the delete process has been done.
        try
        {
            $member->delete();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_members_index')->with('warning_message', 'تمّ حذف العضو بنجاح.');
    }

    public function moveUp($id)
    {
        $member = Member::find($id);

        if (!$member)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف عضو صحيح.');
        }

        // Check if the sorting/moving up process went okay.
        $moved_member = $member->moveUp();

        if (is_null($moved_member))
        {
            return Redirect::back()->with('error_message', 'لا يمكن تحريك العضو للأعلى ربما لأنّه هو الأوّل.');
        }

        return Redirect::route('admin_members_index')->with('success_message', 'تمّ إعادة الترتيب بنجاح.');
    }

    public function moveDown($id)
    {
        $member = Member::find($id);

        if (!$member)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف عضو صحيح.');
        }

        // Check if the sorting/moving down process went okay.
        $moved_member = $member->moveDown();

        if (is_null($moved_member))
        {
            return Redirect::back()->with('error_message', 'لا يمكن تحريك العضو إلى الأسفل ربما لأنّه الأخير.');
        }

        return Redirect::route('admin_members_index')->with('success_message', 'تمّ إعادة الترتيب بنجاح.');
    }

}
