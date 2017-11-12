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

Route::get('talks/{talk}', 'TalkController@show')->name('talk.show');

Route::namespace('Auth')->group(function () {
    Route::get('register', 'RegisterController@create')->name('auth.register.create');
    Route::post('register', 'RegisterController@store')->name('auth.register.store');
});
