<?php

class AlbumsController extends \BaseController {

    public function index()
    {
        // Get the albums.
        $albums = Album::orderBy('created_at', 'DESC')->get();
        return View::make('albums.index')->with('albums', $albums);
    }

    public function adminIndex()
    {
        return View::make('albums.admin.index')
            ->with('albums', Album::orderBy('created_at', 'DESC')
            ->with('photos')->get());
    }

    public function create()
    {
        return View::make('albums.admin.create');
    }

    public function store()
    {
        // Validate and all.
        $title = Input::get('title');
        $description = Input::get('description');

        $validator = Validator::make([
            'title' => $title,
            'description' => $description,
        ], [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails())
        {
            // Update the error language to be in Arabic.
            return Redirect::back()->withInput()->with('error_message', 'الرجاء تعبئة الحقول بشكل صحيح.');
        }

        // Create a new album table record.
        try
        {
            $album = new Album();
            $album->title = $title;
            $album->description = $description;
            $album->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route("admin_albums_index")->with('success_message', 'تمّ إضافة الألبوم بنجاح.');
    }

    public function show($id)
    {
        $album = Album::find($id);

        if (!$album)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف ألبوم صحيح.');
        }

        $album->views_count++;
        $album->save();

        return View::make('albums.show')->with('album', $album);
    }

    public function adminShow($id)
    {
        $album = Album::find($id);

        if (!$album)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف ألبوم صحيح.');
        }

        return View::make('albums.admin.show')
            ->with('albums', Album::orderBy('created_at', 'DESC')
            ->with('photos')->get());
    }

    public function like($id)
    {
        $album = Album::find($id);

        if (!$album)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف ألبوم صحيح.');
        }

        $album->likes_count++;
        $album->save();

        // TODO: Set that the user has liked the album before.

        return Redirect::route('albums_show', [$album->id])->with('success_message', 'تمّ تسجيل إعجابك بالألبوم بنجاح.');
    }

    public function edit($id)
    {
        $album = Album::find($id);

        if (!$album)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف ألبوم صحيح.');
        }

        return View::make('albums.admin.edit')->with('album', $album);
    }

    public function update($id)
    {
        $album = Album::find($id);

        if (!$album)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف ألبوم صحيح.');
        }

        // Validate and all.
        $url = Input::get('url');
        $title = Input::get('title');
        $description = Input::get('description');

        $validator = Validator::make([
            'url' => $url,
            'title' => $title,
            'description' => $description,
        ], [
            'url' => 'required|url',
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails())
        {
            // Update the message to be an appropriate one.
            return Redirect::back()->withInput()->with('error_message', 'الرجاء تعبئة الحقول بشكل صحيح.');
        }

        // Update the current album.
        try
        {
            $album->url = $url;
            $album->title = $title;
            $album->description = $description;
            $album->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_albums_index')->with('success_message', 'تمّ تحديث الألبوم بنجاح.');
    }

    public function destroy($id)
    {
        $album = Album::find($id);

        if (!$album)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف ألبوم صحيح.');
        }

        // Check if the delete process has been done.
        try
        {
            $album->delete();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_albums_index')->with('warning_message', 'تمّ حذف الألبوم بنجاح.');
    }

}
