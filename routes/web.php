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

Route::get('/home', function () {
    $cnt = Session::get('cnt',0);
    $cnt++;
    if($cnt>5)$cnt=0;
    Session::put('cnt', $cnt);

    return view('home', [
        'cnt'=>$cnt
    ]);
});
Route::get('/sign-in', function () {
    return view('sign-in', []);
});
Route::get('/sign-up', function () {
    return view('sign-up', []);
});

Route::get('/products', function () {
    return view('products', []);
});

Route::get('/contacts', function () {
    return view('contacts', []);
});

Route::get('/orders', function () {
    return view('orders', []);
});

Route::get('/customer-service', function () {
    return view('customer-service', []);
});

Route::get('/offers', function () {
    return view('offers', []);
});

Route::get('/about-us', function () {
    return view('about-us', []);
});

Route::get('/captcha', function () {
    return view('captcha', []);
});

// Route::get('/captcha-str', function () {
//     return u::resp(1, u::getSession('captcha',''));
// });

