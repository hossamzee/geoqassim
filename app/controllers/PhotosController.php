<?php

class PhotosController extends \BaseController {

    public function index()
    {
        // Get the photos.
        $photos = Photo::orderBy('created_at', 'DESC')->get();
        return View::make('photos.index')->with('photos', $photos);
    }

    public function adminIndex($album_id)
    {
        $album = Album::find($album_id);

        if (!$album)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف ألبوم صحيح.');
        }

        return View::make('photos.admin.index')
            ->with('photos', Photo::where('album_id', '=', $album->id)->orderBy('created_at', 'DESC')->get())
            ->with('album', $album);
    }

    public function create($album_id)
    {
        $album = Album::find($album_id);

        if (!$album)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف ألبوم صحيح.');
        }

        return View::make('photos.admin.create')->with('album', $album);
    }

    public function store($album_id)
    {
        // Validate and all.
        $photo = Input::file('photo');
        $title = Input::get('title');
        $description = Input::get('description');

        $validator = Validator::make([
            'photo' => $photo,
            'title' => $title,
            'description' => $description,
        ], [
            'photo' => 'required|image',
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails())
        {
            // Update the error language to be in Arabic.
            return Redirect::back()->withInput()->with('error_message', 'الرجاء تعبئة الحقول بشكل صحيح.');
        }

        // Create a new photo table record.
        try
        {
            // Create the two photos, large and thumb.
            $photo_name = Str::random(40) . '.png';

            // Make the large photo first.
            $large_photo = Image::make($photo->getRealPath());
            $large_photo->save(public_path() . '/photos/large/' . $photo_name);

            // Make the thumb photo secondly.
            $thumb_photo = Image::make($photo->getRealPath());

            $thumb_photo->widen(389, function ($constraint) {
              $constraint->upsize();
            });

            $thumb_photo->save(public_path() . '/photos/thumb/' . $photo_name);

            // Set the URLs for both, large and thumb.
            $large_photo_url = url('/photos/large/' . $photo_name);
            $thumb_photo_url = url('/photos/thumb/' . $photo_name);

            // After everything, save the photo in photos table.
            $photo = new Photo();
            $photo->album_id = $album_id;
            $photo->title = $title;
            $photo->description = $description;
            $photo->large_url = $large_photo_url;
            $photo->thumb_url = $thumb_photo_url;
            $photo->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route("admin_photos_index", [$album_id])->with('success_message', 'تمّ إضافة الصورة بنجاح.');
    }

    public function show($id)
    {
        $photo = Photo::find($id);

        if (!$photo)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف صورة صحيح.');
        }

        $photo->views_count++;
        $photo->save();

        return View::make('photos.show')->with('photo', $photo);
    }

    public function like($id)
    {
        $photo = Photo::find($id);

        if (!$photo)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف صورة صحيح.');
        }

        $photo->likes_count++;
        $photo->save();

        // TODO: Set that the user has liked the photo before.

        return Redirect::route('photos_show', [$photo->id])->with('success_message', 'تمّ تسجيل إعجابك بالصورة بنجاح.');
    }

    public function edit($id)
    {
        $photo = Photo::find($id);

        if (!$photo)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف صورة صحيح.');
        }

        return View::make('photos.admin.edit')->with('photo', $photo);
    }

    public function update($id)
    {
        $photo = Photo::find($id);

        if (!$photo)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف صورة صحيح.');
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

        // Update the current photo.
        try
        {
            $photo->url = $url;
            $photo->title = $title;
            $photo->description = $description;
            $photo->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_photos_index')->with('success_message', 'تمّ تحديث الصورة بنجاح.');
    }

    public function destroy($id)
    {
        $photo = Photo::find($id);

        if (!$photo)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف صورة صحيح.');
        }

        // Check if the delete process has been done.
        try
        {
            $photo->delete();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_albums_index')->with('warning_message', 'تمّ حذف الصورة بنجاح.');
    }

}
