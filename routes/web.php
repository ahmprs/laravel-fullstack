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
 use App\Util as u;
 use App\calendar;

Route::get('/home', function () {
    return view('home', ['root_url'=> u::getRootUrl()]);
});

Route::get('/admin-area', function () {
    return view('admin-area', [
        'root_url'=> u::getRootUrl(),
        'tbl_users'=>DB::table('tbl_users'),
        'tbl_files'=>DB::table('tbl_files'),
        'calendar'=> new Calendar(),
        'calendar_class'=>Calendar::class,
        ]);
});

Route::get('/', function () {
    return view('home', ['root_url'=> u::getRootUrl()]);
});

Route::get('/sign-in', function () {
    return view('sign-in', ['root_url'=> u::getRootUrl()]);
});
Route::get('/sign-up', function () {
    return view('sign-up', ['root_url'=> u::getRootUrl()]);
});

Route::get('/products', function () {
    return view('products', [
        'root_url'=> u::getRootUrl(),
        'calendar'=> new Calendar(),
    ]);
});

Route::get('/contacts', function () {
    return view('contacts', ['root_url'=> u::getRootUrl()]);
});

Route::get('/orders', function () {
    return view('orders', ['root_url'=> u::getRootUrl()]);
});

Route::get('/customer-service', function () {
    return view('customer-service', ['root_url'=> u::getRootUrl()]);
});

Route::get('/offers', function () {
    return view('offers', ['root_url'=> u::getRootUrl()]);
});

Route::get('/about-us', function () {
    return view('about-us', ['root_url'=> u::getRootUrl()]);
});

Route::get('/captcha', function () {
    return view('captcha', ['root_url'=> u::getRootUrl()]);
});

Route::get('/test', function () {
    return view('test', ['root_url'=> u::getRootUrl()]);
});

// Route::get('/captcha-str', function () {
//     return u::resp(1, u::getSession('captcha',''));
// });

