<?php

class VideosController extends \BaseController {

    public function index()
    {
        // Get the videos.
        $videos = Video::orderBy('created_at', 'DESC')->get();
        return View::make('videos.index')->with('videos', $videos);
    }

    public function adminIndex()
    {
        return View::make('videos.admin.index')
            ->with('videos', Video::orderBy('created_at', 'DESC')->get());
    }

    public function create()
    {
        return View::make('videos.admin.create');
    }

    public function store()
    {
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
            // Update the error language to be in Arabic.
            return Redirect::back()->withInput()->with('error_message', 'الرجاء تعبئة الحقول بشكل صحيح.');
        }

        // Create a new video table record.
        try
        {
            $video = new Video();
            $video->url = $url;
            $video->title = $title;
            $video->description = $description;
            $video->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route("admin_videos_index")->with('success_message', 'تمّ إضافة الفيديو بنجاح.');
    }

    public function show($id)
    {
        $video = Video::find($id);

        if (!$video)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف فيديو صحيح.');
        }

        $video->views_count++;
        $video->save();

        return View::make('videos.show')->with('video', $video);
    }

    public function edit($id)
    {
        $video = Video::find($id);

        if (!$video)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف فيديو صحيح.');
        }

        return View::make('videos.admin.edit')->with('video', $video);
    }

    public function update($id)
    {
        $video = Video::find($id);

        if (!$video)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف فيديو صحيح.');
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

        // Update the current video.
        try
        {
            $video->url = $url;
            $video->title = $title;
            $video->description = $description;
            $video->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_videos_index')->with('success_message', 'تمّ تحديث الفيديو بنجاح.');
    }

    public function destroy($id)
    {
        $video = Video::find($id);

        if (!$video)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف فيديو صحيح.');
        }

        // Check if the delete process has been done.
        try
        {
            $video->delete();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_videos_index')->with('warning_message', 'تمّ حذف الفيديو بنجاح.');
    }

}
