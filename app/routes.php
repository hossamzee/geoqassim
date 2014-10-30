<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
 * News.
 */

Route::get('news', [
    'as' => 'news_index',
    'uses' => 'NewsController@index'
]);

Route::get('news/{id}', [
    'as' => 'news_show',
    'uses' => 'NewsController@show'
]);

Route::get('news/{id}/like', [
    'as' => 'news_like',
    'uses' => 'NewsController@like'
]);

/*
 * Pages.
 */

Route::get('/', [
    'as' => 'home',
    'uses' => 'PagesController@home'
]);

Route::get('pages/{id}', [
    'as' => 'pages_show',
    'uses' => 'PagesController@show'
]);

Route::get('pages/{id}/like', [
    'as' => 'pages_like',
    'uses' => 'PagesController@like'
]);

/*
 * Contact.
 */

Route::get('contact', [
    'as' => 'contact_get',
    'uses' => 'PagesController@getContact'
]);

Route::post('contact', [
    'as' => 'contact_post',
    'uses' => 'PagesController@postContact'
]);

/*
 * Videos.
 */

Route::get('videos', [
    'as' => 'videos_index',
    'uses' => 'VideosController@index'
]);

/*
 * Admin.
 * TODO: Should be filtered before accessing.
 */

Route::group(['prefix' => 'admin'], function()
{
    /*
     * News.
     */

    Route::get('news', [
        'as' => 'admin_news_index',
        'uses' => 'NewsController@adminIndex'
    ]);

    Route::get('news/create', [
        'as' => 'admin_news_create',
        'uses' => 'NewsController@create'
    ]);

    Route::post('news/create', [
        'as' => 'admin_news_store',
        'uses' => 'NewsController@store'
    ]);

    Route::get('news/{id}/edit', [
         'as' => 'admin_news_edit',
         'uses' => 'NewsController@edit'
    ]);

    Route::post('news/{id}/edit', [
        'as' => 'admin_news_update',
        'uses' => 'NewsController@update'
    ]);

    Route::get('news/{id}/delete', [
        'as' => 'admin_news_destroy',
        'uses' => 'NewsController@destroy'
    ]);

    /*
     * Pages.
     */

    Route::get('pages', [
        'as' => 'admin_pages_index',
        'uses' => 'PagesController@adminIndex'
    ]);

    Route::get('pages/create', [
        'as' => 'admin_pages_create',
        'uses' => 'PagesController@create'
    ]);

    Route::post('pages/create', [
        'as' => 'admin_pages_store',
        'uses' => 'PagesController@store'
    ]);

    Route::get('pages/{id}/edit', [
        'as' => 'admin_pages_edit',
        'uses' => 'PagesController@edit'
    ]);

    Route::post('pages/{id}/edit', [
        'as' => 'admin_pages_update',
        'uses' => 'PagesController@update'
    ]);

    Route::get('pages/{id}/delete', [
        'as' => 'admin_pages_destroy',
        'uses' => 'PagesController@destroy'
    ]);

    /*
     * Videos.
     */

    Route::get('videos', [
        'as' => 'admin_videos_index',
        'uses' => 'VideosController@adminIndex'
    ]);

    Route::get('videos/create', [
        'as' => 'admin_videos_create',
        'uses' => 'VideosController@create'
    ]);

    Route::post('videos/create', [
        'as' => 'admin_videos_store',
        'uses' => 'VideosController@store'
    ]);

    Route::get('videos/{id}/edit', [
        'as' => 'admin_videos_edit',
        'uses' => 'VideosController@edit'
    ]);

    Route::post('videos/{id}/edit', [
        'as' => 'admin_videos_update',
        'uses' => 'VideosController@update'
    ]);

    Route::get('videos/{id}/delete', [
        'as' => 'admin_videos_destroy',
        'uses' => 'VideosController@destroy'
    ]);

});