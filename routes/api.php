<?php

use Illuminate\Http\Request;
use App\AhmUtil;
use App\Http\Controllers\AhmController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/say-hello', 'AhmController@sayHello')->middleware('ahmdlvr');
// Route::post('/say-hello', 'AhmController@sayHello')->middleware('ahmdlvr');

Route::get('/say-hello', 'AhmController@sayHello');
Route::post('/say-hello', 'AhmController@sayHello');

Route::get('/add-numbers', 'AhmController@addNumbers');
Route::post('/add-numbers', 'AhmController@addNumbers');

Route::get('/upload', 'AhmController@handleUpload');
Route::post('/upload', 'AhmController@handleUpload');
