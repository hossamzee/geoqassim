<?php

class NewsController extends \BaseController {

	public function index()
	{
		return View::make('news.index')
            ->with('news', News::orderBy('created_at', 'DESC')->get());
	}

    public function adminIndex()
    {
        return View::make('news.admin.index')
            ->with('news', News::orderBy('created_at', 'DESC')->get());
    }

	public function create()
	{
		return View::make('news.admin.create');
	}

	public function store()
	{
		// Validate and all.
        $title = Input::get('title');
        $content = Input::get('content');

        $validator = Validator::make([
            'title' => $title,
            'content' => $content,
        ], [
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails())
        {
            // Update the error language to be in Arabic.
            return Redirect::back()->withInput()->with('error_message', 'الرجاء تعبئة الحقول بشكل صحيح.');
        }

        // Create a new news table record.
        try
        {
            $news = new News();
            $news->title = $title;
            $news->content = $content;
            $news->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route("admin_news_index")->with('success_message', 'تمّ إضافة الخبر بنجاح.');
	}

	public function show($id)
	{
        $news = News::find($id);

        if (!$news)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف خبر صحيح.');
        }

        $news->views_count++;
        $news->save();

		return View::make('news.show')->with('news', $news);
	}

    public function like($id)
    {
        $news = News::find($id);

        if (!$news)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف خبر صحيح.');
        }

        $news->likes_count++;
        $news->save();

        // TODO: Set that the user has liked the news before.

        return Redirect::route('news_show', [$news->id])->with('success_message', 'تمّ تسجيل إعجابك بالخبر بنجاح.');
    }


	public function edit($id)
	{
        $news = News::find($id);

        if (!$news)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف خبر صحيح.');
        }

        return View::make('news.admin.edit')->with('news', $news);
	}


	public function update($id)
	{
        $news = News::find($id);

        if (!$news)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف خبر صحيح.');
        }

        // Validate and all.
        $title = Input::get('title');
        $content = Input::get('content');

        $validator = Validator::make([
            'title' => $title,
            'content' => $content,
        ], [
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails())
        {
            // Update the message to be an appropriate one.
            return Redirect::back()->withInput()->with('error_message', 'الرجاء تعبئة الحقول بشكل صحيح.');
        }

        // Create a new news table record.
        try
        {
            $news->title = $title;
            $news->content = $content;
            $news->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_news_index')->with('success_message', 'تمّ تحديث الخبر بنجاح.');
	}

	public function destroy($id)
	{
		$news = News::find($id);

        if (!$news)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف خبر صحيح.');
        }

        // Check if the delete process has been done.
        try
        {
            $news->delete();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_news_index')->with('warning_message', 'تمّ حذف الخبر بنجاح.');
	}


}
