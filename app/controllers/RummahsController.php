<?php

class RummahsController extends \BaseController {

    public function index()
    {
        // Get the rummahs.
        $rummahs = Rummah::all();
        return View::make('rummahs.index')->with('rummahs', $rummahs);
    }

    public function adminIndex()
    {
        return View::make('rummahs.admin.index')
            ->with('rummahs', Rummah::orderBy('created_at', 'DESC')->get());
    }

    public function create()
    {
        return View::make('rummahs.admin.create');
    }

    public function store()
    {
        // Validate and all.
        $title = Input::get('title');
        $version = Input::get('version');
        $description = Input::get('description');
        $cover = Input::file('cover');
        $url = Input::get('url');

        $validator = Validator::make([
            'title' => $title,
            'version' => $version,
            'description' => $description,
            'cover' => $cover,
            'url' => $url,
        ], [
            'title' => 'required',
            'version' => 'required',
            'description' => 'required',
            'cover' => 'required|image',
            'url' => 'required|url',
        ]);

        if ($validator->fails())
        {
            // Update the error language to be in Arabic.
            return Redirect::back()->withInput()->with('error_message', 'الرجاء تعبئة الحقول بشكل صحيح.');
        }

        // Create a new rummah table record.
        try
        {
            // Create a new cover, or upload it.
            $cover_name = Str::random(40) . '.png';

            // Make the large photo.
            // TODO: Resize the cover to be appropriate.
            $large_cover = Image::make($cover->getRealPath());
            $large_cover->save(public_path() . '/photos/large/' . $cover_name);

            // Set the URL for the large.
            $large_cover_url = url('/photos/large/' . $cover_name);

            // After everything, save the rummah into the database.
            $rummah = new Rummah();
            $rummah->title = $title;
            $rummah->version = $version;
            $rummah->description = $description;
            $rummah->cover_url = $large_cover_url;
            $rummah->url = $url;
            $rummah->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route("admin_rummahs_index")->with('success_message', 'تمّ إضافة الرمّة بنجاح.');
    }

    public function show($id)
    {
        $rummah = Rummah::find($id);

        if (!$rummah)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف رمّة صحيح.');
        }

        // Update the views count.
        $rummah->views_count++;
        $rummah->save();

        return Redirect::to($rummah->url);
    }

    public function like($id)
    {
        $rummah = Rummah::find($id);

        if (!$rummah)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف رمّة صحيح.');
        }

        // Check if the user already liked the rummah.
        $cookie_name = 'rummahs_' . $rummah->id;
        $rummahs_like = Cookie::get($cookie_name);

        if ($rummahs_like)
        {
            return Redirect::route('rummahs_index')->with('error_message', 'لقد أبديت إعجابك مسبقاً بهذه الرمّة.');
        }

        // Make it forever.
        $cookie = Cookie::forever($cookie_name, 'true');

        $rummah->likes_count++;
        $rummah->save();

        // TODO: Set that the user has liked the news before.

        return Redirect::route('rummahs_index')->with('success_message', 'تمّ تسجيل إعجابك بالرمّة بنجاح.')->withCookie($cookie);
    }

    public function edit($id)
    {
        $rummah = Rummah::find($id);

        if (!$rummah)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف رمّة صحيح.');
        }

        return View::make('rummahs.admin.edit')->with('rummah', $rummah);
    }

    public function update($id)
    {
        $rummah = Rummah::find($id);

        if (!$rummah)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف رمّة صحيح.');
        }

        // Validate and all.
        $title = Input::get('title');
        $version = Input::get('version');
        $description = Input::get('description');
        $cover = Input::file('cover');
        $url = Input::get('url');

        $validator = Validator::make([
            'title' => $title,
            'version' => $version,
            'description' => $description,
            'cover' => $cover,
            'url' => $url,
        ], [
            'title' => 'required',
            'version' => 'required',
            'description' => 'required',
            'cover' => 'image',
            'url' => 'required|url',
        ]);

        if ($validator->fails())
        {
            // Update the message to be an appropriate one.
            return Redirect::back()->withInput()->with('error_message', 'الرجاء تعبئة الحقول بشكل صحيح.');
        }

        // Update the current rummah.
        try
        {
            if ($cover)
            {
                // Create a new cover, or upload it.
                $cover_name = Str::random(40) . '.png';

                // Make the large photo.
                // TODO: Resize the cover to be appropriate.
                $large_cover = Image::make($cover->getRealPath());
                $large_cover->save(public_path() . '/photos/large/' . $cover_name);

                // Set the URL for the large.
                $large_cover_url = url('/photos/large/' . $cover_name);

                // Update the URL in the database.
                $rummah->cover_url = $large_cover_url;
            }

            $rummah->title = $title;
            $rummah->version = $version;
            $rummah->description = $description;
            $rummah->url = $url;
            $rummah->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_rummahs_index')->with('success_message', 'تمّ تحديث الرمّة بنجاح.');
    }

    public function destroy($id)
    {
        $rummah = Rummah::find($id);

        if (!$rummah)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف رمّة صحيح.');
        }

        // Check if the delete process has been done.
        try
        {
            $rummah->delete();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_rummahs_index')->with('warning_message', 'تمّ حذف الرمّة بنجاح.');
    }

}
