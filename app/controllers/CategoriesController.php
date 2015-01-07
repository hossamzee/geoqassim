<?php

class CategoriesController extends \BaseController {

    public function index()
    {
        // Get the categories.
        $categories = Category::orderBy('position', 'DESC')->with('researches')->get();
        return View::make('categories.index')->with('categories', $categories);
    }

    public function adminIndex()
    {
        return View::make('categories.admin.index')
            ->with('categories', Category::orderBy('position', 'DESC')
            ->with('researches')->get());
    }

    public function create()
    {
        return View::make('categories.admin.create');
    }

    public function store()
    {
        // Validate and all.
        $title = Input::get('title');

        $validator = Validator::make([
            'title' => $title,
        ], [
            'title' => 'required',
        ]);

        if ($validator->fails())
        {
            // Update the error language to be in Arabic.
            return Redirect::back()->withInput()->with('error_message', 'الرجاء تعبئة الحقول بشكل صحيح.');
        }

        // Create a new category table record.
        try
        {
            $category = new Category();
            $category->title = $title;
            $category->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route("admin_categories_index")->with('success_message', 'تمّ إضافة تصنيف الأبحاث و الدراسات بنجاح.');
    }

    public function like($id)
    {
        $category = Category::find($id);

        if (!$category)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف تصنيف أبحاث و دراسات صحيح.');
        }

        // Check if the user already liked the category.
        $cookie_name = 'categories_' . $category->id;
        $categories_like = Cookie::get($cookie_name);

        if ($categories_like)
        {
            return Redirect::route('categories_index')->with('error_message', 'لقد أبديت إعجابك مسبقاً بتصنيف الأبحاث و الدراسات هذا.');
        }

        // Make it forever.
        $cookie = Cookie::forever($cookie_name, 'true');

        $category->likes_count++;
        $category->save();

        return Redirect::route('categories_index')->with('success_message', 'تمّ تسجيل إعجابك بتصنيف الأبحاث و الدراسات بنجاح.')->withCookie($cookie);
    }

    public function edit($id)
    {
        $category = Category::find($id);

        if (!$category)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف تصنيف أبحاث و دراسات صحيح.');
        }

        return View::make('categories.admin.edit')->with('category', $category);
    }

    public function update($id)
    {
        $category = Category::find($id);

        if (!$category)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف تصنيف أبحاث و دراسات صحيح.');
        }

        // Validate and all.
        $title = Input::get('title');

        $validator = Validator::make([
            'title' => $title,
        ], [
            'title' => 'required',
        ]);

        if ($validator->fails())
        {
            // Update the message to be an appropriate one.
            return Redirect::back()->withInput()->with('error_message', 'الرجاء تعبئة الحقول بشكل صحيح.');
        }

        // Update the current category.
        try
        {
            $category->title = $title;
            $category->save();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_categories_index')->with('success_message', 'تمّ تحديث تصنيف الأبحاث و الدراسات بنجاح.');
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف تصنيف أبحاث و دراسات صحيح.');
        }

        // Check if the delete process has been done.
        try
        {
            // Delete all related researches.
            Research::where('category_id', '=', $category->id)->delete();

            $category->delete();
        }
        catch (Exception $exception)
        {
            // Log about the error.
            Log::error($exception);
            return Redirect::home()->with('error_message', 'يبدو أنّه هناك خطأ في الخادم.');
        }

        return Redirect::route('admin_categories_index')->with('warning_message', 'تمّ حذف تصنيف الأبحاث و الدراسات بنجاح.');
    }

    public function moveUp($id)
    {
        $category = Category::find($id);

        if (!$category)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف تصنيف أبحاث و دراسات صحيح.');
        }

        // Check if the sorting/moving up process went okay.
        $moved_category = $category->moveUp();

        if (is_null($moved_category))
        {
            return Redirect::back()->with('error_message', 'لا يمكن تحريك تصنيف الأبحاث و الدراسات للأعلى ربما لأنّه هو الأوّل.');
        }

        return Redirect::route('admin_categories_index')->with('success_message', 'تمّ إعادة الترتيب بنجاح.');
    }

    public function moveDown($id)
    {
        $category = Category::find($id);

        if (!$category)
        {
            return Redirect::home()->with('error_message', 'الرجاء التأكد من طلب معرّف تصنيف أبحاث و دراسات صحيح.');
        }

        // Check if the sorting/moving down process went okay.
        $moved_category = $category->moveDown();

        if (is_null($moved_category))
        {
            return Redirect::back()->with('error_message', 'لا يمكن تحريك تصنيف الأبحاث و الدراسات إلى الأسفل ربما لأنّه الأخير.');
        }

        return Redirect::route('admin_categories_index')->with('success_message', 'تمّ إعادة الترتيب بنجاح.');
    }

}
