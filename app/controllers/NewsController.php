<?php

class NewsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('news.index')
            ->with('news', News::all());
	}

    public function adminIndex()
    {
        return "Hello World";
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('news.admin.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// TODO: Validate and all.
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
            // TODO: Update the message to be an appropriate one.
            return Redirect::back()->withErrors($validator)->withInput();
        }

//        $slug = $this->slug(Input::get('title'));

        // TODO: Create a new news table record.
        News::create([
//            'slug' => $slug,
            'title' => $title,
            'content' => $content,
        ]);
	}

//    private function slug($string, $withDate = true)
//    {
//        $string = str_replace('/', '', $string);
//
//        // Lowercase the letters.
//        $string = strtolower($string);
//
//        // Replace the spaces with dashes (-).
//        $string = str_replace(' ', '-', $string);
//
//        if ($withDate)
//        {
//            $string = Carbon::now()->format('d-m-y') . '-' . $string;
//        }
//
//        return $string;
//    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $news = News::find($id);
		return View::make('news.show')->with('news', $news);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('news.edit');
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
