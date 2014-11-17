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
        $token = Session::token();
        return View::make('rummahs.admin.create')->with('token', $token);
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
            'url' => $url,
            'cover' => $cover,
        ], [
            'title' => 'required',
            'version' => 'required',
            'description' => 'required',
            'url' => 'required|url',
            'cover' => 'required|image',
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

            // Make the thumb photo secondly.
            $thumb_cover = Image::make($cover->getRealPath());

            $thumb_cover->widen(Rummah::PHOTO_WIDTH, function ($constraint) {
              $constraint->upsize();
            });

            $thumb_cover->save(public_path() . '/photos/thumb/' . $cover_name);

            $thumb_cover_url = url('/photos/thumb/' . $cover_name);

            // After everything, save the rummah into the database.
            $rummah = new Rummah();
            $rummah->title = $title;
            $rummah->version = $version;
            $rummah->description = $description;
            $rummah->cover_url = $thumb_cover_url;
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

                // Make the thumb photo secondly.
                $thumb_cover = Image::make($cover->getRealPath());

                $thumb_cover->widen(Rummah::PHOTO_WIDTH, function ($constraint) {
                  $constraint->upsize();
                });

                $thumb_cover->save(public_path() . '/photos/thumb/' . $cover_name);

                $thumb_cover_url = url('/photos/thumb/' . $cover_name);

                // Update the URL in the database.
                $rummah->cover_url = $thumb_cover_url;
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
