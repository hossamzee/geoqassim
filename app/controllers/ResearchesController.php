<?php

class ResearchesController extends \BaseController {

    public function index($category_id)
    {
        // Check if the category does exist.
        $category = Category::find($category_id);

        if (!$category)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكّد من طلب معرّف تصنيف أبحاث و دراسات صحيح.');
        }

        $category->views_count++;
        $category->save();

        // Get the researches.
        $researches = Research::where('category_id', '=', $category->id)->orderBy('position', 'DESC')->get();

        return View::make('researches.index')->with(compact('category', 'researches'));
    }

    public function adminIndex($category_id)
    {
        // Check if the category does exist.
        $category = Category::find($category_id);

        if (!$category)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكّد من طلب معرّف تصنيف أبحاث و دراسات صحيح.');
        }

        $researches = Research::where('category_id', '=', $category->id)->orderBy('position', 'DESC')->get();

        return View::make('researches.admin.index')->with(compact('category', 'researches'));
    }

    public function create($category_id)
    {
        // Check if the category does exist.
        $category = Category::find($category_id);

        if (!$category)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكّد من طلب معرّف تصنيف أبحاث و دراسات صحيح.');
        }

        $categories = [];

        foreach (Category::all() as $one_category)
        {
            $categories[$one_category->id] = $one_category->title;
        }

        // For uploading purposes.
        $token = Session::token();

        return View::make('researches.admin.create')->with(compact('category', 'categories', 'token'));
    }

    public function store()
    {
        // Validate and all.
        $title = Input::get('title');
        $category_id = Input::get('category_id');
        $author = Input::get('author');
        $publish_year = Input::get('publish_year');
        $url = Input::get('url');

        $validator = Validator::make([
            'category_id' => $category_id,
            'title' => $title,
            'author' => $author,
            'publish_year' => $publish_year,
            'url' => $url,
        ], [
            'category_id' => 'required',
            'title' => 'required',
            'author' => 'required',
            'publish_year' => 'required|numeric',
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
            $research->category_id = $category_id;
            $research->title = $title;
            $research->author = $author;
            $research->publish_year = $publish_year;
            $research->url = $url;

            $research->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            //Log::error($exception);
            dd($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route("admin_researches_index", [$category_id])->with('success_message', 'تمّ إضافة البحث و الدراسة بنجاح.');
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

    public function show($category_id, $id)
    {
        // Check if the category does exist.
        $category = Category::find($category_id);

        if (!$category)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكّد من طلب معرّف تصنيف أبحاث و دراسات صحيح.');
        }

        $category->views_count++;
        $category->save();

        // Check if the research does exist.
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
            return Redirect::route('researches_index', [$research->category_id])->with('error_message', 'لقد أبديت إعجابك مسبقاً بهذا البحث و الدراسة.');
        }

        // Make it forever.
        $cookie = Cookie::forever($cookie_name, 'true');

        $research->likes_count++;
        $research->save();

        return Redirect::route('researches_index', [$research->category_id])->with('success_message', 'تمّ تسجيل إعجابك بالبحث و الدراسة بنجاح.')->withCookie($cookie);
    }

    public function edit($id)
    {
        $categories = [];

        foreach (Category::all() as $one_category)
        {
            $categories[$one_category->id] = $one_category->title;
        }

        $research = Research::find($id);

        if (!$research)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف بحث و دراسة صحيح.');
        }

        return View::make('researches.admin.edit')->with(compact('categories', 'research'));
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
        $category_id = Input::get('category_id');
        $author = Input::get('author');
        $publish_year = Input::get('publish_year');
        $url = Input::get('url');

        $validator = Validator::make([
            'category_id' => $category_id,
            'title' => $title,
            'author' => $author,
            'publish_year' => $publish_year,
            'url' => $url,
        ], [
            'category_id' => 'required',
            'title' => 'required',
            'author' => 'required',
            'publish_year' => 'required|numeric',
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
            $research->category_id = $category_id;
            $research->title = $title;
            $research->author = $author;
            $research->publish_year = $publish_year;
            $research->url = $url;
            $research->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_researches_index', [$research->category_id])->with('success_message', 'تمّ تحديث البحث و الدراسة بنجاح.');
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

        return Redirect::route('admin_researches_index', [$research->category_id])->with('warning_message', 'تمّ حذف البحث و الدراسة بنجاح.');
    }

    public function moveUp($id)
    {
        $research = Research::find($id);

        if (!$research)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف بحث و دراسة صحيح.');
        }

        // Check if the sorting/moving up process went okay.
        $moved_research = $research->moveUp();

        if (is_null($moved_research))
        {
            return Redirect::back()->with('error_message', 'لا يمكن تحريك البحث و الدراسة للأعلى ربما لأنّها هي الأوّلى.');
        }

        return Redirect::route('admin_researches_index', [$research->category_id])->with('success_message', 'تمّ إعادة الترتيب بنجاح.');
    }

    public function moveDown($id)
    {
        $research = Research::find($id);

        if (!$research)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف بحث و دراسة صحيح.');
        }

        // Check if the sorting/moving down process went okay.
        $moved_research = $research->moveDown();

        if (is_null($moved_research))
        {
            return Redirect::back()->with('error_message', 'لا يمكن تحريك البحث و الدراسة إلى الأسفل ربما لأنّها الأخيرة.');
        }

        return Redirect::route('admin_researches_index', [$research->category_id])->with('success_message', 'تمّ إعادة الترتيب بنجاح.');
    }

}
