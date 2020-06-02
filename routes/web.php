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
 use Illuminate\Http\Request;
 use App\Util as u;
 use App\Calendar;

 Route::get('/', function () {
    return redirect('public/home/');
});

Route::get('/home', function () {
    return redirect('public/home/');
});

Route::get('/home', function () {
    return view('home', [
        'root_url'=> u::getRootUrl(),
        'calendar'=> new Calendar(),
    ]);
});

Route::get('/admin-area', function () {
    return view('admin-area', [
        'root_url'=> u::getRootUrl(),
        'tbl_users'=>DB::table('tbl_users'),
        'tbl_files'=>DB::table('tbl_files'),
        'calendar'=> new Calendar(),
        'calendar_class'=>Calendar::class,
        ]);
})->middleware('only-admin');


// Route::get('/', function () {
//     $cl = new Calendar();
//     return view('home', [
//         'root_url'=> u::getRootUrl(),
//         'calendar'=> $cl,
//     ]);
// });

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
    return view('contacts', [
        'root_url'=> u::getRootUrl(),
        'calendar'=> new Calendar(),
    ]);
});

Route::get('/orders', function () {
    return view('orders', [
        'root_url'=> u::getRootUrl(),
        'calendar'=> new Calendar(),
    ]);
});

Route::get('/customer-service', function () {
    return view('customer-service', [
        'root_url'=> u::getRootUrl(),
        'calendar'=> new Calendar(),
    ]);
});

Route::get('/offers', function () {
    return view('offers', [
        'root_url'=> u::getRootUrl(),
        'calendar'=> new Calendar(),
    ]);
});

Route::get('/about-us', function () {
    return view('about-us', [
        'root_url'=> u::getRootUrl(),
        'calendar'=> new Calendar(),
    ]);
});

Route::get('/captcha', function () {
    return view('captcha', ['root_url'=> u::getRootUrl()]);
});

Route::get('/test', function () {
    // return u::resp(1,1);
    return view('test');
})->middleware('only-admin');


Route::get('/cmd', function(Request $req) {
    $inp = $req->input('inp','');
    if($inp=='') return u::resp(0,[
        'err'=>'missing inp (input command)',
        'reset database'=>'/cmd?inp=migrate:fresh --seed',
        'clear cache'=>'/cmd?inp=cache:clear',
    ]);

    $output = [];

    try {
        \Artisan::call($inp, $output);
    } catch (\Exception $ex) {
        return u::resp(0, $ex->getMessage());
    }

    return u::resp(1,[
        'inp'=>$inp,
        'output'=>$output
    ]);
    // dd($output);
})->middleware('only-admin');

Route::get('/main-css', function(Request $req) {
// 1- read main.css file from public folder
    // public/css/main.css
    $contents = File::get(storage_path('../public/css/main.css'));
    $response = Response::make($contents);
    $response->header('Content-Type', "text/css");
    return $response;
    // return u::resp(1,$contents);
// 2- echo it to output
});


Route::post('/slider-welcome', function (Request $req) {
    return view('slider-welcome');
});

Route::post('/slider-intro', function (Request $req) {
    return view('slider-intro');
});

Route::post('/slider-tech', function (Request $req) {
    return view('slider-tech');
});

Route::post('/slider-web-app', function (Request $req) {
    return view('slider-web-app');
});

Route::post('/slider-smartphone-app', function (Request $req) {
    return view('slider-smartphone-app');
});

Route::post('/slider-desktop-app', function (Request $req) {
    return view('slider-desktop-app');
});


Route::get('/top-menu', function(Request $req) {
    $contents = File::get(storage_path('../public/js/app/plg-top-menu.js'));
    $response = Response::make($contents);
    $response->header('Content-Type', "text/javascript");
    return $response;
});

Route::get('/plg-slide-master', function(Request $req) {
        $contents = File::get(storage_path('../public/js/app/plg-slide-master.js'));
        $response = Response::make($contents);
        $response->header('Content-Type', "text/javascript");
        return $response;
});
    