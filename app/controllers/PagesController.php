<?php

class PagesController extends \BaseController {

    public function home()
    {
        // Get the latest everything has been added.
        // The view hanldes the exception that is being throwing when there is no news.
        $last_news = News::orderBy('created_at', 'DESC')->limit(3)->get();
        $last_rummah = Rummah::orderBy('created_at', 'DESC')->first();
        $random_photo = Photo::orderBy(DB::raw('RAND()'))->first();
        $about_page = Page::find(1);

        return View::make('pages.home')->with(compact('last_news', 'last_rummah', 'random_photo', 'about_page'));
    }

    public function adminHome()
    {
        $user = Auth::user();

        // Get some statistics about everything.
        $news_count = News::count();
        $albums_count = Album::count();
        $photos_count = Photo::count();
        $videos_count = Video::count();
        $pages_count  = Page::count();
        $rummahs_count = Rummah::count();
        $members_count = Member::count();
        $users_count = User::count();
        $subscribers_count = Subscriber::count();
        $researches_count = Research::count();
        $ads_count = Ad::count();

        return View::make('pages.admin.home')->with(compact('user', 'news_count', 'albums_count', 'photos_count', 'videos_count',
            'pages_count', 'rummahs_count', 'members_count', 'users_count', 'subscribers_count', 'researches_count', 'ads_count'));
    }

    public function getContact()
    {
        $mail_address = Config::get('mail.from.address');
        return View::make('pages.contact')->with('mail_address', $mail_address);
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
            'subject' => e($subject),
            'from' => $from,
            'name' => e($name),
            'content' => nl2br(e($content)),
        ];

        // Make sure this email has been sent.
        // TODO: This should be queued rather than taking a time and then response to the user.

        Mail::send('emails.contact', $data, function($message) use ($to, $data) {
            $message->from($data['from'], $data['name'])
                    ->to($to)
                    ->subject('موقع قسم الجغرافيا بجامعة القصيم - '. $data['subject']);
        });

        // Make sure that the flash message displays appropriately.
        return Redirect::home()->with('success_message', 'تمّ إرسال رسالتك بنجاح.');
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

    // Thanks to Antoine Augusti.
    // http://blog.antoine-augusti.fr/2014/05/laravel-fulltext-selection-and-ordering/

    public function search()
    {
        // Start calculating the execution time.
        $start = microtime(true);

        $query = Document::sanitize(Input::get('query'));

        // Validate the input.
        $validator = Validator::make([
            'query' => $query,
        ], [
            'query' => 'required|min:4'
        ]);

        // Check the validation.
        if ($validator->fails())
        {
            return Redirect::home()->with('error_message', 'الرجاء إدخال كلمة البحث و التي لا تقل عن 3 أحرف.');
        }

        // Other than that, everything is great.
        // TODO: Maybe rank them then order them by the ranking.
        $results = Document::whereRaw('MATCH(title, content) AGAINST(?)', [$query])->get();

        if ($results->count() == 0)
        {
            return Redirect::home()->with('warning_message', 'لم يتم العثور على نتائج لبحثك.');
        }

        $keywords = explode(' ', $query);

        $finish = microtime(true);

        $taken_time = round(($finish-$start), 3);

        // If there is at least one result, show it.
        return View::make('pages.search')->with(compact('results', 'query', 'keywords', 'taken_time'));
    }
}
