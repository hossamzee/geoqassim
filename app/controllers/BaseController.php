<?php

class BaseController extends Controller {

	/*
	 * Construct the class with the array of latest news.
	 */
	public function __construct()
	{
		$latest_news = News::limit(10)->orderBy('created_at', 'DESC')->get();
		View::share('footer_latest_news', $latest_news);
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
