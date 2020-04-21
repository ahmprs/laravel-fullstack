<?php

use Illuminate\Http\Request;
use App\Util;
use App\Http\Controllers\AppController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/say-hello', 'AppController@sayHello')->middleware('requires-logged-in');
Route::post('/say-hello', 'AppController@sayHello');

Route::get('/add-numbers', 'AppController@addNumbers');
Route::post('/add-numbers', 'AppController@addNumbers');

Route::get('/upload', 'AppController@handleUpload');
Route::post('/upload', 'AppController@handleUpload');


Route::post('/get-login-token', 'AppController@getLoginToken');
Route::get('/get-login-token', 'AppController@getLoginToken');

Route::post('/sign-up', 'AppController@signup');
Route::get('/sign-up', 'AppController@signup');

Route::post('/sign-in', 'AppController@signIn');
Route::get('/sign-in', 'AppController@signIn');

Route::post('/current-user', 'AppController@getCurrentUser');
Route::get('/current-user', 'AppController@getCurrentUser');

Route::post('/log-out', 'AppController@logOut');
Route::get('/log-out', 'AppController@logOut');


Route::post('/show-side-bar', 'AppController@showSideBar');
Route::get('/show-side-bar', 'AppController@showSideBar');

Route::post('/hide-side-bar', 'AppController@hideSideBar');
Route::get('/hide-side-bar', 'AppController@hideSideBar');

Route::post('/get-side-bar-state', 'AppController@getSideBarState');
Route::get('/get-side-bar-state', 'AppController@getSideBarState');

Route::post('/get-root-url', 'AppController@getRootUrl');
Route::get('/get-root-url', 'AppController@getRootUrl');

Route::post('/upload', 'AppController@upload');
Route::get('/upload', 'AppController@upload');

