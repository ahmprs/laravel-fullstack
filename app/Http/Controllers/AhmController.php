<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AhmUtil as au;

class AhmController extends Controller
{
    function sayHello(Request $req){
        return au::resp(1, 'Hello from laravel with hope!');
    }

    function addNumbers(Request $req){
        $x = $req->input('x');
        $y = $req->input('y');

        return au::resp(1, $x+$y);
    }

    function handleUpload(Request $req){
        return au::uploadHttpProcess($req);
    }

    
}
