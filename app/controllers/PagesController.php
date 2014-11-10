<?php

class PagesController extends \BaseController {

    public function home()
    {
        // Get the latest everything has been added.
        // TODO: Hanlde the exception that is being throwing when there is no news.
        $last_news = News::orderBy('created_at', 'DESC')->first();
        $last_rummah = Rummah::orderBy('created_at', 'DESC')->first();
        $last_video = Video::orderBy('created_at', 'DESC')->first();

        return View::make('pages.home')
                ->with('last_news', $last_news)
                ->with('last_rummah', $last_rummah)
                ->with('last_video', $last_video);
    }

    public function adminHome()
    {
        return View::make('pages.admin.home');
    }


    public function getContact()
    {
        return View::make('pages.contact');
    }

    public function postContact()
    {
        //
        $name = Input::get('name');
        $from = Input::get('email');
        $subject = Input::get('subject');
        $content = Input::get('content');

        $validator = Validator::make([
            'name' => $name,
            'from' => $from,
            'subject' => $subject,
            'content' => $content,
        ], [
            'name' => 'required',
            'from' => 'required|email',
            'subject' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails())
        {
            // Display a readable error.
            return Redirect::back()->withInput()->with('error_message', 'الرجاء تعبئة الحقول بشكل صحيح.');;
        }

        //
        $to = Config::get('mail.from.address');

        //
        $data = [
            'subject' => $subject,
            'from' => $from,
            'name' => $name,
            'content' => $content,
        ];

        // Make sure this email has been sent.
        // TODO: This should be queued rather than taking a time and then response to the user.

        Mail::send('emails.contact', $data, function($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)
                    ->to($to)
                    ->subject('موقع قسم الجغرافيا بجامعة القصيم - '. $subject);
        });

        // TODO: Make sure that the flash message displays appropriately.
        return Redirect::home()->with('message', 'Greate!');
    }

    public function adminIndex()
    {
        return View::make('pages.admin.index')
            ->with('pages', Page::orderBy('created_at', 'DESC')->get());
    }

    public function create()
    {
        return View::make('pages.admin.create');
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

        // Create a new page table record.
        try
        {
            $page = new Page();
            $page->title = $title;
            $page->content = $content;
            $page->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route("admin_pages_index")->with('success_message', 'تمّ إضافة الصفحة بنجاح.');
    }

    public function show($id)
    {
        $page = Page::find($id);

        if (!$page)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف صفحة صحيح.');
        }

        $page->views_count++;
        $page->save();

        return View::make('pages.show')->with('page', $page);
    }

    public function like($id)
    {
        $page = Page::find($id);

        if (!$page)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف صفحة صحيح.');
        }

        // Check if the user already liked the page.
        $cookie_name = 'pages_' . $page->id;
        $pages_like = Cookie::get($cookie_name);

        if ($pages_like)
        {
            return Redirect::route('pages_show', [$page->id])->with('error_message', 'لقد أبديت إعجابك مسبقاً بهذه الصفحة.');
        }

        // Make it forever.
        $cookie = Cookie::forever($cookie_name, 'true');

        $page->likes_count++;
        $page->save();

        // TODO: Set that the user has liked the page before.

        return Redirect::route('pages_show', [$page->id])->with('success_message', 'تمّ تسجيل إعجابك بالصفحة بنجاح.')->withCookie($cookie);
    }

    public function edit($id)
    {
        $page = Page::find($id);

        if (!$page)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف صفحة صحيح.');
        }

        return View::make('pages.admin.edit')->with('page', $page);
    }

    public function update($id)
    {
        $page = Page::find($id);

        if (!$page)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف صفحة صحيح.');
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

        // Update the current page.
        try
        {
            $page->title = $title;
            $page->content = $content;
            $page->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_pages_index')->with('success_message', 'تمّ تحديث الصفحة بنجاح.');
    }

    public function destroy($id)
    {
        $page = Page::find($id);

        if (!$page)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف صفحة صحيح.');
        }

        // Check if the delete process has been done.
        try
        {
            $page->delete();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_pages_index')->with('warning_message', 'تمّ حذف الصفحة بنجاح.');
    }

}
