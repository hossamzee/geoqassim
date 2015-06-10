<?php

class AdsController extends \BaseController {

	public function index()
	{
		return View::make('ads.index')
            ->with('ads', Ad::orderBy('created_at', 'DESC')->get());
	}

  public function adminIndex()
  {
      return View::make('ads.admin.index')
          ->with('ads', Ad::orderBy('created_at', 'DESC')->get());
  }

	public function create()
	{
		return View::make('ads.admin.create');
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

        // Create a new ads table record.
        try
        {
            $ad = new Ad();
            $ad->title = $title;
            $ad->content = $content;
            $ad->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route("admin_ads_index")->with('success_message', 'تمّ إضافة الإعلان بنجاح.');
	}

	public function show($id)
	{
        $ad = Ad::find($id);

        if (!$ad)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف إعلان صحيح.');
        }

        $ad->views_count++;
        $ad->save();

		return View::make('ads.show')->with('ad', $ad);
	}

    public function like($id)
    {
        $ad = Ad::find($id);

        if (!$ad)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف إعلان صحيح.');
        }

				// Check if the user already liked the ad.
				$cookie_name = 'ads_' . $ad->id;
				$ads_like = Cookie::get($cookie_name);

				if ($ads_like)
				{
						return Redirect::route('ads_show', [$ad->id])->with('error_message', 'لقد أبديت إعجابك مسبقاً بهذا الإعلان.');
				}

				// Make it forever.
				$cookie = Cookie::forever($cookie_name, 'true');

        $ad->likes_count++;
        $ad->save();

        return Redirect::route('ads_show', [$ad->id])->with('success_message', 'تمّ تسجيل إعجابك بالإعلان بنجاح.')->withCookie($cookie);
    }

	public function edit($id)
	{
        $ad = Ad::find($id);

        if (!$ad)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف إعلان صحيح.');
        }

        return View::make('ads.admin.edit')->with('ad', $ad);
	}

	public function update($id)
	{
        $ad = Ad::find($id);

        if (!$ad)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف إعلان صحيح.');
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

        // Create a new ad table record.
        try
        {
            $ad->title = $title;
            $ad->content = $content;
            $ad->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_ads_index')->with('success_message', 'تمّ تحديث الإعلان بنجاح.');
	}

	public function destroy($id)
	{
		$ad = Ad::find($id);

        if (!$ad)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف إعلان صحيح.');
        }

        // Check if the delete process has been done.
        try
        {
            $ad->delete();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_ads_index')->with('warning_message', 'تمّ حذف الإعلان بنجاح.');
	}

}
