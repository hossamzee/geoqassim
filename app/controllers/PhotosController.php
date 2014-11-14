<?php

class PhotosController extends \BaseController {

    public function index($album_id)
    {
        return $this->show($album_id, null);
    }

    public function show($album_id, $id)
    {
        // Check if the album does exist.
        $album = Album::find($album_id);

        if (!$album)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكّد من طلب معرّف ألبوم صحيح.');
        }

        $album->views_count++;
        $album->save();

        // Get the chosen or the latest photo.
        if ($id == null)
        {
            $photo = Photo::where('album_id', '=', $album->id)->orderBy('id', 'DESC')->first();
        }
        else
        {
            $photo = Photo::where('album_id', '=', $album->id)->where('id', '=', $id)->orderBy('id', 'DESC')->first();
        }

        if ($photo == null)
        {
            return Redirect::home()->with('error_message', 'لم يتم إضافة صور حتّى الآن أو أن معرّف الصورة غير صحيح.');
        }

        // Update the views count.
        $photo->views_count++;
        $photo->save();

        // Get the previous photos.
        $previous_photos = Photo::where('album_id', '=', $album->id)->where('id', '<', $photo->id)->orderBy('id', 'DESC')->limit(Photo::PHOTOS_PER_PAGE/2)->get();

        // Get the next photos.
        $next_photos = Photo::where('album_id', '=', $album->id)->where('id', '>', $photo->id)->orderBy('id', 'ASC')->limit(Photo::PHOTOS_PER_PAGE/2)->get();

        // Set the related photos.
        $related_photos = $previous_photos->merge($next_photos);

        return View::make("photos.show")
                ->with('album', $album)
                ->with('photo', $photo)
                ->with('previous_photos', $previous_photos)
                ->with('next_photos', $next_photos)
                ->with('related_photos', $related_photos);
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

            $thumb_photo->widen(165, function ($constraint) {
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

    public function getBulk($album_id)
    {
        $album = Album::find($album_id);

        if (!$album)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف ألبوم صحيح.');
        }

        return View::make('photos.admin.bulk')->with('album', $album);
    }

    public function postBulk($album_id)
    {
        // TODO: Check if the total size of the photos is accepted.

        $photos = Input::file('photos');

        // Validate and all.
        foreach ($photos as $photo)
        {
            $validator = Validator::make([
                'photo' => $photo,
            ], [
                'photo' => 'required|image',
            ]);

            if ($validator->fails())
            {
                // Update the error language to be in Arabic.
                return Redirect::back()->withInput()->with('error_message', 'الرجاء التأكد من اختيار ملفات صور.');
            }
        }

        $failed_photos_count = 0;

        // Try to upload the photos.
        foreach ($photos as $photo)
        {
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

                $thumb_photo->widen(165, function ($constraint) {
                  $constraint->upsize();
                });

                $thumb_photo->save(public_path() . '/photos/thumb/' . $photo_name);

                // Set the URLs for both, large and thumb.
                $large_photo_url = url('/photos/large/' . $photo_name);
                $thumb_photo_url = url('/photos/thumb/' . $photo_name);

                // After everything, save the photo in photos table.
                $_photo = new Photo();
                $_photo->album_id = $album_id;
                $_photo->title = $photo->getClientOriginalName();
                $_photo->large_url = $large_photo_url;
                $_photo->thumb_url = $thumb_photo_url;
                $_photo->save();
            }
            catch (Exception $exception)
            {
                // Log about the error.
                Log::error($exception);
                $failed_photos_count++;
            }
        }

        if ($failed_photos_count > 0)
        {
            return Redirect::route("admin_photos_index", [$album_id])->with('warning_message', 'تمّ إضافة الصور بنجاح مع تعذّر ' . $failed_photos_count . ' صور عن الرفع.');
        }

        return Redirect::route("admin_photos_index", [$album_id])->with('success_message', 'تمّ إضافة الصور بنجاح.');
    }

    public function like($id)
    {
        $photo = Photo::find($id);

        if (!$photo)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف صورة صحيح.');
        }

        // Check if the user already liked the photo.
        $cookie_name = 'photos_' . $photo->id;
        $photos_like = Cookie::get($cookie_name);

        if ($photos_like)
        {
            return Redirect::route('photos_show', [$photo->album_id, $photo->id])->with('error_message', 'لقد أبديت إعجابك مسبقاً بهذه الصورة.');
        }

        // Make it forever.
        $cookie = Cookie::forever($cookie_name, 'true');

        $photo->likes_count++;
        $photo->save();

        return Redirect::route('photos_show', [$photo->album_id, $photo->id])->with('success_message', 'تمّ تسجيل إعجابك بالصورة بنجاح.')->withCookie($cookie);
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
        $current_photo = Photo::find($id);

        if (!$current_photo)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف صورة صحيح.');
        }

        // Validate and all.
        $photo = Input::file('photo');
        $title = Input::get('title');
        $description = Input::get('description');

        $validator = Validator::make([
            'photo' => $photo,
            'title' => $title,
            'description' => $description,
        ], [
            'photo' => 'image',
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
            if ($photo)
            {
                // Create the two photos, large and thumb.
                $photo_name = Str::random(40) . '.png';

                // Make the large photo first.
                $large_photo = Image::make($photo->getRealPath());
                $large_photo->save(public_path() . '/photos/large/' . $photo_name);

                // Make the thumb photo secondly.
                $thumb_photo = Image::make($photo->getRealPath());

                $thumb_photo->widen(165, function ($constraint) {
                  $constraint->upsize();
                });

                $thumb_photo->save(public_path() . '/photos/thumb/' . $photo_name);

                // Set the URLs for both, large and thumb.
                $large_photo_url = url('/photos/large/' . $photo_name);
                $thumb_photo_url = url('/photos/thumb/' . $photo_name);

                $current_photo->large_url = $large_photo_url;
                $current_photo->thumb_url = $thumb_photo_url;
            }

            $current_photo->title = $title;
            $current_photo->description = $description;
            $current_photo->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_photos_index', [$current_photo->album_id])->with('success_message', 'تمّ تحديث الصورة بنجاح.');
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
