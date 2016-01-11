<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


use PostCheck\User;

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/home', 'HomeController@index');
    Route::get('/dashboard', 'DashboardController@index');

    Route::get('/', function () {
        return view('landing-page');
    });

    Route::resource('feeds', 'FeedsController');
    Route::post('feeds/multi', 'FeedsController@multi');

    Route::get('/facebook/callback', 'FacebookController@callback');


});
