<?php

use Illuminate\Http\Request;
use App\Util as u;
use App\Calendar;
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


Route::post('/update-document-properties', 'AppController@updateDocumentProperties');
Route::get('/update-document-properties', 'AppController@updateDocumentProperties');


Route::post('/delete-document', 'AppController@deleteDocument');
Route::get('/delete-document', 'AppController@deleteDocument');

Route::post('/update-settings', 'AppController@updateSettings');
Route::get('/update-settings', 'AppController@updateSettings');


Route::post('/save-div-doc', 'AppController@saveDivDoc');
Route::get('/save-div-doc', 'AppController@saveDivDoc');

Route::post('/new-div-doc', 'AppController@newDivDoc');
Route::get('/new-div-doc', 'AppController@newDivDoc');

Route::post('/get-div-doc', 'AppController@getDivDoc');
Route::get('/get-div-doc', 'AppController@getDivDoc');

Route::post('/delete-div-doc', 'AppController@deleteDivDoc');
Route::get('/delete-div-doc', 'AppController@deleteDivDoc');

Route::post('/new-plugin', 'AppController@newPlugin');
Route::get('/new-plugin', 'AppController@newPlugin');

Route::post('/get-plugin', 'AppController@getPlugin');
Route::get('/get-plugin', 'AppController@getPlugin');

Route::post('/save-plugin', 'AppController@savePlugin');
Route::get('/save-plugin', 'AppController@savePlugin');


Route::get('/test', function(){
    return u::resp(1, u::getRootDir());
});



