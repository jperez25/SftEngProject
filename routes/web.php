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

Route::get('/', function () {
    return view('welcome');
})->name('index');

Auth::routes(['verify' => true]);

Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/profile/{userID}', 'ProfileController@show')->middleware('auth');
Route::get('/friendrequest/{userID}', 'HomeController@sendFriendReq');

Route::get('/profile', 'ProfileController@index')->middleware('auth')->name('profile.index');
Route::get('/profile/edit', 'ProfileController@edit')->middleware('auth');
Route::resource('profile', 'ProfileController')->middleware('auth');

Route::get('/chat', 'ChatController@index')->middleware('auth')->name('chat.index');
Route::get('/chat/{id}', 'ChatController@show')->middleware('auth')->name('chat.show');
Route::post('/chat/getChat/{id}', 'ChatController@getChat')->middleware('auth');
Route::post('/chat/sendChat', 'ChatController@sendChat')->middleware('auth');