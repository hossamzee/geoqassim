<?php

class ResearchesController extends \BaseController {

    public function index()
    {
        // Get the researches.
        $researches = Research::all();
        return View::make('researches.index')->with('researches', $researches);
    }

    public function adminIndex()
    {
        return View::make('researches.admin.index')
            ->with('researches', Research::orderBy('created_at', 'DESC')->get());
    }

    public function create()
    {
        $token = Session::token();
        return View::make('researches.admin.create')->with('token', $token);
    }

    public function store()
    {
        // Validate and all.
        $title = Input::get('title');
        $author = Input::get('author');
        $url = Input::get('url');

        $validator = Validator::make([
            'title' => $title,
            'author' => $author,
            'url' => $url,
        ], [
            'title' => 'required',
            'author' => 'required',
            'url' => 'required|url',
        ]);

        if ($validator->fails())
        {
            // Update the error language to be in Arabic.
            return Redirect::back()->withInput()->with('error_message', 'الرجاء تعبئة الحقول بشكل صحيح.');
        }

        // Create a new research table record.
        try
        {
            // After everything, save the research into the database.
            $research = new Research();
            $research->title = $title;
            $research->author = $author;
            $research->url = $url;

            $research->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route("admin_researches_index")->with('success_message', 'تمّ إضافة البحث و الدراسة بنجاح.');
    }

    public function upload()
    {
        $pdf = Input::file('pdf');

        // Validate and all.
        $validator = Validator::make([
            'pdf' => $pdf,
        ], [
            'pdf' => 'required|mimes:pdf',
        ]);

        if ($validator->fails())
        {
            return Response::json([
                'message' => 'There is an error with your request.',
            ], 400);
        }

        // Initialize the URL.
        $url = null;

        try
        {
            $pdf_name = Str::random(40) . '.pdf';
            $pdf->move(public_path() . '/pdfs', $pdf_name);
            $url = url('/pdfs/' . $pdf_name);
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);

            return Response::json([
                'message' => 'An internal server error.'
            ], 500);
        }

        // Done.
        return Response::json([
            'url' => $url,
        ], 200);
    }

    public function show($id)
    {
        $research = Research::find($id);

        if (!$research)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف بحث و دراسة صحيح.');
        }

        // Update the views count.
        $research->views_count++;
        $research->save();

        return Redirect::to($research->url);
    }

    public function like($id)
    {
        $research = Research::find($id);

        if (!$research)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف بحث و دراسة صحيح.');
        }

        // Check if the user already liked the research.
        $cookie_name = 'researches_' . $research->id;
        $researches_like = Cookie::get($cookie_name);

        if ($researches_like)
        {
            return Redirect::route('researches_index')->with('error_message', 'لقد أبديت إعجابك مسبقاً بهذا البحث و الدراسة.');
        }

        // Make it forever.
        $cookie = Cookie::forever($cookie_name, 'true');

        $research->likes_count++;
        $research->save();

        return Redirect::route('researches_index')->with('success_message', 'تمّ تسجيل إعجابك بالبحث و الدراسة بنجاح.')->withCookie($cookie);
    }

    public function edit($id)
    {
        $research = Research::find($id);

        if (!$research)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف بحث و دراسة صحيح.');
        }

        return View::make('researches.admin.edit')->with('research', $research);
    }

    public function update($id)
    {
        $research = Research::find($id);

        if (!$research)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف بحث و دراسة صحيح.');
        }

        // Validate and all.
        $title = Input::get('title');
        $author = Input::get('author');
        $url = Input::get('url');

        $validator = Validator::make([
            'title' => $title,
            'author' => $author,
            'url' => $url,
        ], [
            'title' => 'required',
            'author' => 'required',
            'url' => 'required|url',
        ]);

        if ($validator->fails())
        {
            // Update the message to be an appropriate one.
            return Redirect::back()->withInput()->with('error_message', 'الرجاء تعبئة الحقول بشكل صحيح.');
        }

        // Update the current research.
        try
        {
            $research->title = $title;
            $research->author = $author;
            $research->url = $url;
            $research->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_researches_index')->with('success_message', 'تمّ تحديث البحث و الدراسة بنجاح.');
    }

    public function destroy($id)
    {
        $research = Research::find($id);

        if (!$research)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف بحث و دراسة صحيح.');
        }

        // Check if the delete process has been done.
        try
        {
            $research->delete();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_researches_index')->with('warning_message', 'تمّ حذف البحث و الدراسة بنجاح.');
    }

}
