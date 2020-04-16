<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util as u;
use Session;
use DB;
use App\tbl_users;

class AppController extends Controller
{
    function sayHello(Request $req){
        return u::resp(1, 'Hello with hope!');
    }

    function addNumbers(Request $req){
        $x = $req->input('x');
        $y = $req->input('y');

        return u::resp(1, $x+$y);
    }

    function handleUpload(Request $req){
        return u::uploadHttpProcess($req);
    }

    function getLoginToken(){
        $r = rand(1000000000, 11000000000);
        $lt = hash('md5', "$r");
        Session::put('login-token', $lt);        
        return u::resp(1,$lt);
    }

    function signup(Request $req){
        
        if(Session::get('user_id','')!=''){
            return u::resp(0, [
                'err'=>'already logged in',
                'hint'=>'sign out first'
            ]);
        }

        $user_name= $req->get('user_name', '');
        if($user_name == ''){
            return u::resp(0,[
                'err'=>'missing user name',
            ]);
        }

        $user_pass_hash = $req->get('user_pass_hash','');
        if($user_pass_hash == ''){
            return u::resp(0,[
                'err'=>'missing pass hash',
            ]);
        }

        $user_email= $req->get('user_email', '');
        if($user_email == ''){
            return u::resp(0,[
                'err'=>'missing user email',
            ]);
        }

        $u = DB::table('tbl_users')->where('user_name', $user_name)->first();
        if($u != null){
            return u::resp(0,[
                'err'=>'the user name is not available',
                'hint'=>'try another user name'
            ]);
        }

        $rec_id = DB::table('tbl_users')->insertGetId([
            'user_id' => null,
            'user_name' => $user_name,
            'user_pass_hash' => $user_pass_hash,
            'user_email' => $user_email,
            'user_active' => '1',
            'user_access_level' => '1',
            'user_reset_token' => '',
            'user_desc' => '',
        ]);        
        
        Session::put('user_id', $rec_id);
        Session::put('user_name', $user_name);
        Session::put('user_email', $user_email);
        Session::put('user_access_level', 1);
        Session::put('user_active', 1);

        $res = $rec_id > 0 ? 1 : 0;
        return u::resp($res, 'signup succeeded');

        // DB::table('tbl_users')->where('user_name');
    }

    function getCurrentUser(){
        if(Session::get('user_id','')==''){
            return u::resp(0, [
                'err'=>'user not logged in',
            ]);
        }

        return u::resp(1, [
            'user_id'=>Session::get('user_id'),
            'user_name'=>Session::get('user_name',''),
            'user_email'=>Session::get('user_email',''),
            'user_access_level'=>Session::get('user_access_level',''),
            'user_active'=>Session::get('user_active',''),
        ]);
    }

    function logOut(){
        if(Session::get('user_id','')==''){
            return u::resp(0, 'already logged out');
        }

        Session::forget('user_id');
        Session::forget('user_name');
        Session::forget('user_email');
        Session::forget('user_access_level');
        Session::forget('user_active');
        return u::resp(1, 'logged out');
    }

    function signIn(Request $req){
        // 1- get the user name
        // 2- get user digest as g
        // 3- search tbl_users and find the user
        // 4- get database hash of password as p
        // 5- make server-side md5 hash by concatenating login-token and p as j
        // 6- return j==g
    }

    function showSideBar(){
        Session::put('side-bar',true);
        return u::resp(1, 'side bar shown');        
    }

    function hideSideBar(){
        Session::put('side-bar',false);
        return u::resp(1, 'side bar hide');        
    }

    function getSideBarState(){
        return u::resp(1, [
            'side-bar'=>Session::get('side-bar', false)
        ]);        
    }
    
}
