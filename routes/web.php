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
#Root
Route::get('/', 'Controller@index')->name('index');

#Auth and verification routes
Auth::routes(['verify' => true]);
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

#Profile Routes
Route::get('/profile', 'ProfileController@index')->middleware('auth')->name('profile.index');
Route::get('/profile/edit', 'ProfileController@edit')->middleware('auth');
Route::resource('profile', 'ProfileController')->middleware('auth');
Route::get('/profile/{userID}', 'ProfileController@show')->middleware('auth');
Route::get('/profile/{userID}', 'ProfileController@update')->middleware('auth');

#Ratings Routes
Route::get('/ratings/{userID}', 'ReviewController@show')->middleware('auth');
Route::post('/ratings/create', 'ReviewController@create')->middleware('auth');
Route::post('/ratings/{userID}', 'ReviewController@store')->middleware('auth');
Route::resource('/ratings', 'ReviewController')->middleware('auth');

#Search Users and others Routes
#Route::resource('home', 'HomeController')->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::post('/home','HomeController@search')->middleware('auth');
Route::get('/fetchReqs', 'HomeController@fetchReqs')->middleware('auth');

#Group options Routes
Route::get('/getOwner/{group_id}', 'HomeController@getOwner')->middleware('auth');
Route::get('/getFriends', 'HomeController@getFriends')->middleware('auth');
Route::post('/addFriends', 'HomeController@addFriends')->middleware('auth');
Route::post('/deleteGroupMembers', 'HomeController@deleteGroupMembers')->middleware('auth');
Route::get('/getMembersOfGroup/{group_id}', 'HomeController@getMembersOfGroup')->middleware('auth');
Route::post('/delete_group/{group_id}', 'GroupController@delete_group')->middleware('auth');
Route::get('/getCurrentUser', 'HomeController@getCurrentUser')->middleware('auth');
Route::post('/leave_group', 'HomeController@leave_group')->middleware('auth');
Route::post('/change_group_name/', 'HomeController@change_group_name')->middleware('auth');


#Friend Request Routes
Route::get('/friendrequest/{userID}', 'HomeController@sendFriendReq')->middleware('auth');
Route::get('/acceptFriendReq/{userID}', 'HomeController@acceptFriendReq')->middleware('auth'); 
Route::get('/deleteFriendReq/{userID}', 'HomeController@deleteFriendReq')->middleware('auth');
//Route::get('/friendRequestEvent/{userID}', 'HomeController@friendRequestEvent');

#Friend List
Route::get('/friend', 'FriendController@index')->name('friend')->middleware('auth');

#Chat Routes
//Route::get('/chat', 'ChatController@index')->middleware('auth')->name('chat.index');
//Route::get('/chat/{id}', 'ChatController@show')->middleware('auth')->name('chat.show');
//Route::post('/chat/getChat/{id}', 'ChatController@getChat')->middleware('auth');
//Route::post('/chat/sendChat', 'ChatController@sendChat')->middleware('auth');
Route::get('/group', 'GroupController@index')->name('group')->middleware('auth');
Route::resource('groups', 'GroupController')->middleware('auth');
Route::resource('conversations', 'ConversationController')->middleware('auth');
Route::get('/conversation/{id}', 'ConversationController@getMessage')->name('conversations.getMessage')->middleware('auth');


#Admin Routes
Route::get('/admin', 'AdminController@index')->middleware('auth')->name('admin');