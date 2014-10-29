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
 * Pages.
 */
Route::get('/', [
   'as' => 'home',
    'uses' => 'PagesController@getHome'
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
 * Admin.
 * TODO: Should be filtered before accessing.
 */

Route::group(['prefix' => 'admin'], function()
{

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

});