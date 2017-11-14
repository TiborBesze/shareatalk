<?php

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

Route::get('/', 'HomeController@index')->name('home');

Route::prefix('talks')->group(function () {
    Route::get('create', 'TalkController@create')->name('talk.create');
    Route::post('/', 'TalkController@store')->name('talk.store');

    Route::get('{talk}', 'TalkController@show')->name('talk.show');

    Route::post('{talk}/like', 'LikeController@store')->name('like.store');
    Route::delete('{talk}/like', 'LikeController@destroy')->name('like.destroy');
});

Route::prefix('users')->group(function () {
    Route::post('{user}/follow', 'FollowController@store')->name('follow.store');
    Route::delete('{user}/follow', 'FollowController@destroy')->name('follow.destroy');
});

Route::namespace('Auth')->group(function () {
    Route::get('register', 'RegisterController@create')->name('auth.register.create');
    Route::post('register', 'RegisterController@store')->name('auth.register.store');

    Route::get('login', 'LoginController@create')->name('auth.login.create');
    Route::post('login', 'LoginController@store')->name('auth.login.store');

    Route::delete('logout', 'LoginController@destroy')->name('auth.login.destroy');
});
