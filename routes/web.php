<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MainController@home');
Route::get('/aboutUs', 'MainController@about_us');
Route::get('/contactUs', 'MainController@contact_us');
Route::get('/blog', 'MainController@categories');
Route::get('/blog/{id}', 'MainController@post');

Route::post('/sendMail', 'MainController@send_mail');

Route::get('/admin', function () {
    return view('login');
});
Route::post('/admin', array( 'uses' => 'MainController@doLogin'));

Route::get('admin/logout', 'MainController@logout');
Route::get('/unauthorized', 'MainController@unauthorized')->name('unauthorized');

Route::middleware(['CheckAuth'])->group(function () {
    Route::get('/admin/posts', 'MainController@edit_posts')->name('posts');

    Route::get('/admin/add_post', 'MainController@new_post');
    Route::post('/admin/add_post','MainController@add_post');

    Route::post('/admin/delete', 'MainController@delete_post');
    Route::post('/admin/update', 'MainController@update_post');
    Route::post('/admin/update_post', 'Maincontroller@update_post_insert');

    Route::get('/admin/top_posts', 'MainController@top_posts');
    Route::post('/admin/addTopPost', 'MainController@add_top_post');
    Route::post('/admin/removeTopPost', 'MainController@remove_top_post');
    Route::post('/admin/arrangeTopPost', 'MainController@arrange_top_post');

    Route::get('/admin/carousel', 'MainController@carousel');
    Route::post('/admin/addCarousel', 'MainController@add_carousel');
    Route::post('/admin/removeCarousel', 'MainController@remove_carousel');
    Route::post('/admin/arrangeCarousel', 'MainController@arrange_carousel');

    Route::get('/admin/trendPosts', 'MainController@trend_posts');
    Route::post('/admin/addTrend', 'MainController@add_trend_posts');
    Route::post('/admin/removeTrend', 'MainController@remove_trend_posts');
    Route::post('/admin/arrangeTrend', 'MainController@arrange_trend_posts');

    Route::get('/admin/editorspick', 'MainController@pick_posts');
    Route::post('/admin/addPick', 'MainController@add_pick_posts');
    Route::post('/admin/removePick', 'MainController@remove_pick_posts');
    Route::post('/admin/arrangePick', 'MainController@arrange_pick_posts');

    Route::get('/admin/info', 'MainController@info');
    Route::post('/admin/updateInfo', 'MainController@update_info');

    Route::get('/admin/siteSettings', 'MainController@site_settings');
    Route::post('/admin/updateSiteSettings', 'MainController@update_site_settings');

    Route::get('/admin/changePassword', 'MainController@change_pass');
    Route::post('admin/changePassword','MainController@changePassword')->name('changePassword');
});