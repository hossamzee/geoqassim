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

Route::post('search', [
    'as' => 'search',
    'uses' => 'PagesController@search'
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

Route::get('videos/{id}', [
    'as' => 'videos_show',
    'uses' => 'VideosController@index'
]);

/*
 * Albums & Photos.
 */

Route::get('albums', [
    'as' => 'albums_index',
    'uses' => 'AlbumsController@index'
]);

Route::get('albums/{id}/photos', [
    'as' => 'photos_index',
    'uses' => 'PhotosController@index'
]);

Route::get('albums/{album_id}/photos/{id}', [
    'as' => 'photos_show',
    'uses' => 'PhotosController@show'
]);

Route::get('albums/{id}/like', [
    'as' => 'albums_like',
    'uses' => 'AlbumsController@like'
]);

Route::get('photos/{id}/like', [
    'as' => 'photos_like',
    'uses' => 'PhotosController@like'
]);

/*
 * Members.
 */

Route::get('members', [
    'as' => 'members_index',
    'uses' => 'MembersController@index'
]);

Route::get('members/{id}', [
    'as' => 'members_show',
    'uses' => 'MembersController@show'
]);

/*
 * Rummahs.
 */

Route::get('rummahs', [
    'as' => 'rummahs_index',
    'uses' => 'RummahsController@index'
]);

Route::get('rummahs/{id}', [
    'as' => 'rummahs_show',
    'uses' => 'RummahsController@show'
]);

Route::get('rummahs/{id}/like', [
    'as' => 'rummahs_like',
    'uses' => 'RummahsController@like'
]);

/*
 * Researches (and studies).
 */

Route::get('researches', [
    'as' => 'researches_index',
    'uses' => 'ResearchesController@index'
]);

Route::get('researches/{id}', [
    'as' => 'researches_show',
    'uses' => 'ResearchesController@show'
]);

Route::get('researches/{id}/like', [
    'as' => 'researches_like',
    'uses' => 'ResearchesController@like'
]);

/*
 * Users
 */

Route::get('users/login', [
    'as' => 'users_login_get',
    'uses' => 'UsersController@getLogin'
]);

Route::post('users/login', [
    'as' => 'users_login_post',
    'uses' => 'UsersController@postLogin'
]);

Route::get('users/changepassword', [
    'before' => 'auth',
    'as' => 'users_changepassword_get',
    'uses' => 'UsersController@getChangePassword'
]);

Route::post('users/changepassword', [
    'before' => 'auth',
    'as' => 'users_changepassword_post',
    'uses' => 'UsersController@postChangePassword'
]);

/*
 * Newsletters
 */

Route::post('newsletters/subscribe', [
    'as' => 'newsletters_subscribe',
    'uses' => 'NewslettersController@subscribe'
]);

Route::get('newsletters/{token}/unsubscribe', [
    'as' => 'newsletters_unsubscribe',
    'uses' => 'NewslettersController@unsubscribe'
]);

/*
 * Admin.
 */

Route::group(['prefix' => 'admin', 'before' => 'auth'], function()
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

     Route::get('/', [
         'as' => 'admin_home',
         'uses' => 'PagesController@adminHome'
     ]);

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

    Route::get('videos/{id}/moveup', [
        'as' => 'admin_videos_moveup',
        'uses' => 'VideosController@moveUp'
    ]);

    Route::get('videos/{id}/movedown', [
        'as' => 'admin_videos_movedown',
        'uses' => 'VideosController@moveDown'
    ]);

    /*
     * Albums.
     */

    Route::get('albums', [
        'as' => 'admin_albums_index',
        'uses' => 'AlbumsController@adminIndex'
    ]);

    Route::get('albums/create', [
        'as' => 'admin_albums_create',
        'uses' => 'AlbumsController@create'
    ]);

    Route::post('albums/create', [
        'as' => 'admin_albums_store',
        'uses' => 'AlbumsController@store'
    ]);

    Route::get('albums/{id}/edit', [
        'as' => 'admin_albums_edit',
        'uses' => 'AlbumsController@edit'
    ]);

    Route::post('albums/{id}/edit', [
        'as' => 'admin_albums_update',
        'uses' => 'AlbumsController@update'
    ]);

    Route::get('albums/{id}/delete', [
        'as' => 'admin_albums_destroy',
        'uses' => 'AlbumsController@destroy'
    ]);

    Route::get('albums/{id}/moveup', [
        'as' => 'admin_albums_moveup',
        'uses' => 'AlbumsController@moveUp'
    ]);

    Route::get('albums/{id}/movedown', [
        'as' => 'admin_albums_movedown',
        'uses' => 'AlbumsController@moveDown'
    ]);

    /*
     * Photos.
     */

    Route::get('albums/{id}/photos', [
        'as' => 'admin_photos_index',
        'uses' => 'PhotosController@adminIndex'
    ]);

    Route::get('albums/{id}/photos/create', [
        'as' => 'admin_photos_create',
        'uses' => 'PhotosController@create'
    ]);

    Route::post('albums/{id}/photos/create', [
        'as' => 'admin_photos_store',
        'uses' => 'PhotosController@store'
    ]);

    Route::get('albums/{id}/photos/bulk', [
        'as' => 'admin_photos_bulk_get',
        'uses' => 'PhotosController@getBulk'
    ]);

    Route::post('albums/{id}/photos/bulk', [
        'as' => 'admin_photos_bulk_post',
        'uses' => 'PhotosController@postBulk'
    ]);

    Route::post('photos/upload', [
        'as' => 'admin_photos_upload',
        'uses' => 'PhotosController@upload'
    ]);

    Route::get('photos/{id}/edit', [
        'as' => 'admin_photos_edit',
        'uses' => 'PhotosController@edit'
    ]);

    Route::post('photos/{id}/edit', [
        'as' => 'admin_photos_update',
        'uses' => 'PhotosController@update'
    ]);

    Route::get('photos/{id}/delete', [
        'as' => 'admin_photos_destroy',
        'uses' => 'PhotosController@destroy'
    ]);

    Route::get('photos/{id}/moveup', [
        'as' => 'admin_photos_moveup',
        'uses' => 'PhotosController@moveUp'
    ]);

    Route::get('photos/{id}/movedown', [
        'as' => 'admin_photos_movedown',
        'uses' => 'PhotosController@moveDown'
    ]);

    /*
     * Members.
     */

    Route::get('members', [
        'as' => 'admin_members_index',
        'uses' => 'MembersController@adminIndex'
    ]);

    Route::get('members/create', [
        'as' => 'admin_members_create',
        'uses' => 'MembersController@create'
    ]);

    Route::post('members/create', [
        'as' => 'admin_members_store',
        'uses' => 'MembersController@store'
    ]);

    Route::get('members/{id}/edit', [
        'as' => 'admin_members_edit',
        'uses' => 'MembersController@edit'
    ]);

    Route::post('members/{id}/edit', [
        'as' => 'admin_members_update',
        'uses' => 'MembersController@update'
    ]);

    Route::get('members/{id}/delete', [
        'as' => 'admin_members_destroy',
        'uses' => 'MembersController@destroy'
    ]);

    Route::get('members/{id}/moveup', [
        'as' => 'admin_members_moveup',
        'uses' => 'MembersController@moveUp'
    ]);

    Route::get('members/{id}/movedown', [
        'as' => 'admin_members_movedown',
        'uses' => 'MembersController@moveDown'
    ]);

    /*
     * Rummahs.
     */

    Route::get('rummahs', [
        'as' => 'admin_rummahs_index',
        'uses' => 'RummahsController@adminIndex'
    ]);

    Route::get('rummahs/create', [
        'as' => 'admin_rummahs_create',
        'uses' => 'RummahsController@create'
    ]);

    Route::post('rummahs/create', [
        'as' => 'admin_rummahs_store',
        'uses' => 'RummahsController@store'
    ]);

    Route::post('rummahs/upload', [
        'as' => 'admin_rummahs_upload',
        'uses' => 'RummahsController@upload'
    ]);

    Route::get('rummahs/{id}/edit', [
        'as' => 'admin_rummahs_edit',
        'uses' => 'RummahsController@edit'
    ]);

    Route::post('rummahs/{id}/edit', [
        'as' => 'admin_rummahs_update',
        'uses' => 'RummahsController@update'
    ]);

    Route::get('rummahs/{id}/delete', [
        'as' => 'admin_rummahs_destroy',
        'uses' => 'RummahsController@destroy'
    ]);

    /*
     * Researches.
     */

    Route::get('researches', [
        'as' => 'admin_researches_index',
        'uses' => 'ResearchesController@adminIndex'
    ]);

    Route::get('researches/create', [
        'as' => 'admin_researches_create',
        'uses' => 'ResearchesController@create'
    ]);

    Route::post('researches/create', [
        'as' => 'admin_researches_store',
        'uses' => 'ResearchesController@store'
    ]);

    Route::post('researches/upload', [
        'as' => 'admin_researches_upload',
        'uses' => 'ResearchesController@upload'
    ]);

    Route::get('researches/{id}/edit', [
        'as' => 'admin_researches_edit',
        'uses' => 'ResearchesController@edit'
    ]);

    Route::post('researches/{id}/edit', [
        'as' => 'admin_researches_update',
        'uses' => 'ResearchesController@update'
    ]);

    Route::get('researches/{id}/delete', [
        'as' => 'admin_researches_destroy',
        'uses' => 'ResearchesController@destroy'
    ]);

    Route::get('researches/{id}/moveup', [
        'as' => 'admin_researches_moveup',
        'uses' => 'ResearchesController@moveUp'
    ]);

    Route::get('researches/{id}/movedown', [
        'as' => 'admin_researches_movedown',
        'uses' => 'ResearchesController@moveDown'
    ]);

    /*
     * Users.
     */

    Route::get('users', [
        'before' => 'auth.admin',
        'as' => 'admin_users_index',
        'uses' => 'UsersController@index'
    ]);

    Route::get('users/create', [
        'before' => 'auth.admin',
        'as' => 'admin_users_create',
        'uses' => 'UsersController@create'
    ]);

    Route::post('users/create', [
        'before' => 'auth.admin',
        'as' => 'admin_users_store',
        'uses' => 'UsersController@store'
    ]);

    Route::get('users/{id}/edit', [
        'before' => 'auth.admin',
        'as' => 'admin_users_edit',
        'uses' => 'UsersController@edit'
    ]);

    Route::post('users/{id}/edit', [
        'before' => 'auth.admin',
        'as' => 'admin_users_update',
        'uses' => 'UsersController@update'
    ]);

    Route::get('users/{id}/delete', [
        'before' => 'auth.admin',
        'as' => 'admin_users_destroy',
        'uses' => 'UsersController@destroy'
    ]);

    Route::get('users/logout', [
        'before' => 'auth',
        'as' => 'admin_users_logout',
        'uses' => 'UsersController@logout'
    ]);

    /*
     * Newsletters
     */

    Route::get('newsletters', [
        'as' => 'admin_newsletters_index',
        'uses' => 'NewslettersController@adminIndex'
    ]);

});
