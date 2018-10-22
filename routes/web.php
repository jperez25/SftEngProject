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

Route::resource('groups', 'GroupController');
Route::resource('conversations', 'ConversationController');


Route::get('/profile', 'ProfileController@index')->middleware('auth')->name('profile.index');
Route::get('/profile/edit', 'ProfileController@edit')->middleware('auth');
Route::resource('profile', 'ProfileController')->middleware('auth');
Route::resource('home', 'HomeController')->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/group', 'GroupController@index')->name('group')->middleware('auth');
Route::get('/profile/{userID}', 'ProfileController@show')->middleware('auth');
Route::get('/friendrequest/{userID}', 'HomeController@sendFriendReq');
Route::post('/home','HomeController@search');