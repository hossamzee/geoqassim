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
    'as' => 'contact',
    'uses' => 'PagesController@getContact'
]);

Route::post('contact', [
    'as' => 'contact',
    'uses' => 'PagesController@postContact'
]);

/*
 * News.
 */

Route::get('news', [
    'as' => 'news',
    'uses' => 'NewsController@index'
]);

Route::get('news/{id}', [
    'as' => 'single_news',
    'uses' => 'NewsController@show'
]);

/*
 * Admin.
 * TODO: Should be filtered before accessing.
 */

Route::group(['prefix' => 'admin'], function()
{

    Route::get('news', [
        'as' => 'admin_news',
        'uses' => 'NewsController@adminIndex'
    ]);

    Route::get('news/create', [
        'as' => 'admin_news_create',
        'uses' => 'NewsController@create'
    ]);

    Route::post('news', [
         'as' => 'admin_news',
         'uses' => 'NewsController@store'
    ]);

});