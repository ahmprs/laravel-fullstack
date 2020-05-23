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

Route::get('/upload', 'AppController@handleUpload')->middleware('requires-being-admin');
Route::post('/upload', 'AppController@handleUpload')->middleware('requires-being-admin');

Route::post('/get-login-token', 'AppController@getLoginToken');
Route::get('/get-login-token', 'AppController@getLoginToken');

Route::post('/sign-up', 'AppController@signup');
Route::get('/sign-up', 'AppController@signup');

Route::post('/sign-in', 'AppController@signIn');
Route::get('/sign-in', 'AppController@signIn');

Route::post('/sign-in-inquiry', 'AppController@signInInquiry');
Route::get('/sign-in-inquiry', 'AppController@signInInquiry');

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

Route::post('/upload', 'AppController@upload')->middleware('requires-being-admin');
Route::get('/upload', 'AppController@upload')->middleware('requires-being-admin');


Route::post('/update-document-properties', 'AppController@updateDocumentProperties')->middleware('requires-being-admin');
Route::get('/update-document-properties', 'AppController@updateDocumentProperties')->middleware('requires-being-admin');


Route::post('/delete-document', 'AppController@deleteDocument')->middleware('requires-being-admin');
Route::get('/delete-document', 'AppController@deleteDocument')->middleware('requires-being-admin');

Route::post('/update-settings', 'AppController@updateSettings')->middleware('requires-being-admin');
Route::get('/update-settings', 'AppController@updateSettings')->middleware('requires-being-admin');


Route::post('/save-div-doc', 'AppController@saveDivDoc')->middleware('requires-being-admin');
Route::get('/save-div-doc', 'AppController@saveDivDoc')->middleware('requires-being-admin');

Route::post('/new-div-doc', 'AppController@newDivDoc')->middleware('requires-being-admin');
Route::get('/new-div-doc', 'AppController@newDivDoc')->middleware('requires-being-admin');

Route::post('/get-div-doc', 'AppController@getDivDoc');
Route::get('/get-div-doc', 'AppController@getDivDoc');

Route::post('/delete-div-doc', 'AppController@deleteDivDoc')->middleware('requires-being-admin');
Route::get('/delete-div-doc', 'AppController@deleteDivDoc')->middleware('requires-being-admin');

Route::post('/new-plugin-use', 'AppController@newPluginUse')->middleware('requires-being-admin');
Route::get('/new-plugin-use', 'AppController@newPluginUse')->middleware('requires-being-admin');

Route::post('/get-plugin', 'AppController@getPlugin');
Route::get('/get-plugin', 'AppController@getPlugin');

Route::post('/save-plugin-meta', 'AppController@savePluginMeta')->middleware('requires-being-admin');
Route::get('/save-plugin-meta', 'AppController@savePluginMeta')->middleware('requires-being-admin');

Route::post('/delete-plugin-meta', 'AppController@deletePluginMeta')->middleware('requires-being-admin');
Route::get('/delete-plugin-meta', 'AppController@deletePluginMeta')->middleware('requires-being-admin');

Route::post('/save-plugin-code', 'AppController@savePluginCode')->middleware('requires-being-admin');
Route::get('/save-plugin-code', 'AppController@savePluginCode')->middleware('requires-being-admin');

Route::post('/delete-plugin-code', 'AppController@deletePluginCode')->middleware('requires-being-admin');
Route::get('/delete-plugin-code', 'AppController@deletePluginCode')->middleware('requires-being-admin');

Route::post('/update-user-email-address', 'AppController@updateUserEmailAddress')->middleware('requires-logged-in');
Route::get('/update-user-email-address', 'AppController@updateUserEmailAddress')->middleware('requires-logged-in');

Route::post('/get-user-comments', 'AppController@getUserComments');
Route::get('/get-user-comments', 'AppController@getUserComments');

Route::post('/insert-new-comment', 'AppController@insertNewComment');
Route::get('/insert-new-comment', 'AppController@insertNewComment');

Route::get('/test', function(){
    return u::resp(1, u::getRootDir());
});



