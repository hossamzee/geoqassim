<?php

class BaseController extends Controller {

	/*
	 * Construct the class with the array of latest news.
	 */
	public function __construct()
	{
		// Perform CSRF check on all post/put/patch/delete requests.
    $this->beforeFilter('csrf', ['on' => ['post', 'put', 'patch', 'delete']]);

		$latest_news = News::limit(10)->orderBy('created_at', 'DESC')->get();
		$random_photo = Photo::orderBy(DB::raw('RAND()'))->first();

		View::share('footer_latest_news', $latest_news);
		View::share('footer_random_photo', $random_photo);
		View::share('version', Config::get('version.tag'));
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			// TODO: I beleive there is another way.
			$this->layout = View::make($this->layout);
		}
	}

}
