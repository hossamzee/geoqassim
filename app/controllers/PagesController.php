<?php

class PagesController extends \BaseController {

    public function getHome()
    {
        // Get the latest news has been added.
        // TODO: Hanlde the exception that is being throwing when there is no news.
        $last_news = News::orderBy('created_at', 'DESC')->first();
        $last_news->snippet = str_limit($last_news->content, 400);

        return View::make('pages.home')->with('last_news', $last_news);
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
            // TODO: Display a readable error.
            return Redirect::back()->withErrors($validator)->withInput();
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

    public function create()
    {

    }

    public function store()
    {

    }

    public function show($slug)
    {

    }

}
