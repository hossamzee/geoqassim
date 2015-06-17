<?php

class StudentsController extends \BaseController {

    public function index()
    {
        // Get the students.
        $students = Student::orderBy('position', 'DESC')->get();
        return View::make('students.index')->with('students', $students);
    }

    public function adminIndex()
    {
        return View::make('students.admin.index')
            ->with('students', Student::orderBy('position', 'DESC')->get());
    }

    public function create()
    {
        // Get the genders that could be assigned to a student.
        $genders = Student::$genders;
        return View::make('students.admin.create')->with('genders', $genders);
    }

    public function store()
    {
        // Validate and all.
        $name = Input::get('name');
        $gender = Input::get('gender');
        $major = Input::get('major');
        $interests = Input::get('interests');
        $email = Input::get('email');

        // Set the genders as a string.
        $genders_as_string = implode(',', array_keys(Student::$genders));

        $validator = Validator::make([
            'name' => $name,
            'gender' => $gender,
            'email' => $email,
        ], [
            'name' => 'required',
            'gender' => 'required|in:' . $genders_as_string,
            'email' => 'email',
        ]);

        if ($validator->fails())
        {
            // Update the error language to be in Arabic.
            return Redirect::back()->withInput()->with('error_message', 'الرجاء تعبئة الحقول بشكل صحيح.');
        }

        // Create a new student table record.
        try
        {
            // After everything, save the student into the database.
            $student = new Student();
            $student->name = $name;
            $student->gender = $gender;
            $student->major = $major;
            $student->interests = $interests;
            $student->email = $email;

            //
            $student->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route("admin_students_index")->with('success_message', 'تمّ إضافة العضو بنجاح.');
    }

    public function show($id)
    {
        $student = Student::find($id);

        if (!$student)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف عضو صحيح.');
        }

        return View::make('students.show')->with('student', $student);
    }

    public function edit($id)
    {
        $student = Student::find($id);

        if (!$student)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف عضو صحيح.');
        }

        // Get the genders that could be assigned to a student.
        $genders = Student::$genders;
        return View::make('students.admin.edit')->with('student', $student)->with('genders', $genders);
    }

    public function update($id)
    {
        $student = Student::find($id);

        if (!$student)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف عضو صحيح.');
        }

        // Validate and all.
        $name = Input::get('name');
        $gender = Input::get('gender');
        $major = Input::get('major');
        $interests = Input::get('interests');
        $email = Input::get('email');

        // Set the genders as a string.
        $genders_as_string = implode(',', array_keys(Student::$genders));

        $validator = Validator::make([
            'name' => $name,
            'gender' => $gender,
            'email' => $email,
        ], [
            'name' => 'required',
            'gender' => 'required|in:' . $genders_as_string,
            'email' => 'email',
        ]);

        if ($validator->fails())
        {
            // Update the message to be an appropriate one.
            return Redirect::back()->withInput()->with('error_message', 'الرجاء تعبئة الحقول بشكل صحيح.');
        }

        // Update the current student.
        try
        {
            $student->name = $name;
            $student->gender = $gender;
            $student->major = $major;
            $student->interests = $interests;
            $student->email = $email;

            //
            $student->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_students_index')->with('success_message', 'تمّ تحديث العضو بنجاح.');
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف عضو صحيح.');
        }

        // Check if the delete process has been done.
        try
        {
            $student->delete();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_students_index')->with('warning_message', 'تمّ حذف العضو بنجاح.');
    }

    public function moveUp($id)
    {
        $student = Student::find($id);

        if (!$student)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف عضو صحيح.');
        }

        // Check if the sorting/moving up process went okay.
        $moved_student = $student->moveUp();

        if (is_null($moved_student))
        {
            return Redirect::back()->with('error_message', 'لا يمكن تحريك العضو للأعلى ربما لأنّه هو الأوّل.');
        }

        return Redirect::route('admin_students_index')->with('success_message', 'تمّ إعادة الترتيب بنجاح.');
    }

    public function moveDown($id)
    {
        $student = Student::find($id);

        if (!$student)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف عضو صحيح.');
        }

        // Check if the sorting/moving down process went okay.
        $moved_student = $student->moveDown();

        if (is_null($moved_student))
        {
            return Redirect::back()->with('error_message', 'لا يمكن تحريك العضو إلى الأسفل ربما لأنّه الأخير.');
        }

        return Redirect::route('admin_students_index')->with('success_message', 'تمّ إعادة الترتيب بنجاح.');
    }

}
