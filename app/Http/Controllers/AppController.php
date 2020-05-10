<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util as u;
use Session;
use DB;
use App\tbl_users;
USE App\calendar;

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

        $txt_captcha= $req->get('txt_captcha', '');
        if($txt_captcha == ''){
            return u::resp(0,[
                'err'=>'missing captcha',
            ]);
        }

        $cps = u::getSession('captcha','');
        if($txt_captcha != $cps){
            return u::resp(0,[
                'err'=>'captcha mismatch',
                "cps"=>$cps,
                'txt_captcha'=>$txt_captcha
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

        $txt_captcha= $req->get('txt_captcha', '');
        if($txt_captcha == ''){
            return u::resp(0,[
                'err'=>'missing captcha',
            ]);
        }

        $cps = u::getSession('captcha','');
        if($txt_captcha != $cps){
            return u::resp(0,[
                'err'=>'captcha mismatch',
                "cps"=>$cps,
                'txt_captcha'=>$txt_captcha
            ]);
        }
        
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

        $digest_client= $req->get('digest', '');
        if($digest_client == ''){
            return u::resp(0,[
                'err'=>'missing user password digest',
            ]);
        }


        $u = DB::table('tbl_users')->where('user_name', $user_name)->first();
        if($u == null){
            return u::resp(0,[
                'err'=>'invalid user',
                'hint'=>'try another user name'
            ]);
        }

        
        $user_id = $u->user_id;
        $user_name = $u->user_name;
        $user_email = $u->user_email;
        $user_access_level = $u->user_access_level;
        $user_active = $u->user_active;
        
        $user_pass_hash = $u->user_pass_hash;
        
        $login_token = Session('login-token', '');
        $digest_server =  hash('md5', $user_pass_hash.$login_token);
        
        if($digest_client == $digest_server){
            Session::put('user_id', $user_id);
            Session::put('user_name', $user_name);
            Session::put('user_email', $user_email);
            Session::put('user_access_level', $u->user_access_level);
            Session::put('user_active', $u->user_active);
            
            return u::resp(1,[
                'msg'=>'logged in',
                'user_id'=>$user_id,
                'user_name'=>$user_name,
                'user_email'=>$user_email,
                'user_active'=>$user_active,
                'user_access_level'=>$user_access_level,
            ]);
        }
        
        return u::resp(0,[
            'err'=>'invalid password',
        ]);

        // TEST:        
        // return u::resp(1,[
        //     'user_name'=>$user_name,
        //     'captcha'=>$txt_captcha,
        //     'digest_client'=>$digest_client,
        //     'digest_server'=>$digest_server,
        //     'user'=>$u,
        // ]);

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

    function getRootUrl(){
        return u::resp(1, u::getRootUrl());
    }

    function updateDocumentProperties(Request $req){
        $file_id = $req->input('file_id');
        $file_show = $req->input('file_show');
        $file_gdp_publish = $req->input('file_gdp_publish');
        $file_gdp_expires = $req->input('file_gdp_expires');
        $file_tag = $req->input('file_tag');

        $affected = DB::table('tbl_files')->where('file_id', $file_id)->update([
            'file_show'=>$file_show,
            'file_gdp_publish'=>$file_gdp_publish,
            'file_gdp_expires'=>$file_gdp_expires,
            'file_tag'=>$file_tag,
        ]);
        
        if($affected!=1) return u::resp(0,'update failed');
        return u::resp(1,'update succeed');
    }


    function updateSettings(Request $req){
        $stg_id = $req->input('stg_id');
        $stg_val = $req->input('stg_val');
        $affected = DB::table('tbl_settings')->where('stg_id', $stg_id)->update([
            'stg_val'=>$stg_val,
        ]);
        
        if($affected!=1) return u::resp(0,'update failed');
        return u::resp(1,'update succeed');
    }


    function upload(Request $req){

        $callback = $req->input('callback');

        $upload_max_allowed_file_size_bytes = 5000000;
        // = Settings::get('upload_max_allowed_file_size_bytes');
        
        $arr_allowed_formats=["pdf","pdff"];
        // = Settings::get('upload_allowed_formats');
        
        $user_id = Session::get('user_id','');
        if ($user_id == '') {
            // return u::resp(0, [
            //     'err' => 'access denied',
            //     'hint' => 'please login first',
            // ]);

            header("Location: $callback?upload_state=0&err=1");
            exit;

        }
            

        $posts_dir =  u::getRootDir();//???//storage_path();
        $posts_dir = realpath("$posts_dir/posts");
        
        // return u::resp(0, $posts_dir);

        if(!is_dir($posts_dir)) {
            mkdir($posts_dir, 0755, true);
        }

        if(!is_dir($posts_dir)) {
            // return u::resp(0, [
            //     'err'=>'posts directory does not exist, and cannot be created'
            // ]);
            header("Location: $callback?upload_state=0&err=2");
            exit;
        }

        
        $target_dir = $posts_dir;
        
        
        $cal = new Calendar();
        $gdp = $cal->getServerGdp();
        

        
        $file_uploaded_basic_name = basename($_FILES["fileToUpload"]["name"]);
        $target_file = "$target_dir\\$file_uploaded_basic_name";
        $file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $file_extension = strtolower($file_extension);
        if($file_extension=="pdf"){$file_extension="pdff";}
        $stamp = $cal->getStamp();
        $fnn = "$stamp.$file_extension";
        $file_new_name = "$target_dir\\$fnn";
        $file_tmp_name = $_FILES["fileToUpload"]["tmp_name"];
        


        // IMAGE CHECK SIZE
        // if (isset($_POST["submit"])) {
        //     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        //     if ($check !== false) {
        //         // echo "File is an image - " . $check["mime"] . ".";
        //         $uploadOk = 1;
        //     } else {
        //         $err_msg = "File is not an image.";
        //         $uploadOk = 0;
        //     }
        // }

        // checks if file already exists
        if (file_exists($file_new_name)) {
            // return u::resp(0, [
            //     'err' => 'file already exists',
            //     'hint' => 'try again in a few seconds',
            // ]);
            header("Location: $callback?upload_state=0&err=3");
            exit;
        }

        // check file size
        $file_size_bytes = $_FILES["fileToUpload"]["size"];
        if ($file_size_bytes > $upload_max_allowed_file_size_bytes) {
            // return u::resp(0, [
            //     'err' => 'file is too large',
            //     'file_size_bytes' => $file_size_bytes,
            //     'ttt' => $_FILES["fileToUpload"]["name"],
            // ]);
            header("Location: $callback?upload_state=0&err=4");
            exit;
        }

        // check file extension
        if (!in_array($file_extension, $arr_allowed_formats)) {
            // return u::resp(0, [
            //     'err' => 'extension not allowed',
            //     'extension' => $file_extension,
            //     'allowed_formats' => $arr_allowed_formats,
            //     'file_uploaded_basic_name' => $file_uploaded_basic_name,
            // ]);
            header("Location: $callback?upload_state=0&err=5");
            exit;
        }

        // move temp file to destination
        if (move_uploaded_file($file_tmp_name, $file_new_name)) {

            DB::table('tbl_files')->insert([
                'file_id'=>null,
                'user_id'=>$user_id,
                'file_org_name'=>$file_uploaded_basic_name,
                'file_new_name'=>$fnn,
                'file_size_bytes'=>$file_size_bytes,
                'file_target_dir'=>$target_dir,
                'file_extension'=>$file_extension,
                'file_gdp_create'=>$gdp,
                'file_gdp_publish'=>$gdp,
                'file_gdp_expires'=>$gdp + 90,
                'file_show'=>1,
                'file_tag'=>'',
                'file_title'=>'',
                'file_desc'=>'',
            ]); 
            
            header("Location: $callback?upload_state=1&err=0");
            exit;
            // return u::resp(1, [
            //     'ok' => 'success',
            //     'file_uploaded_basic_name' => $file_uploaded_basic_name,
            //     'file_tmp_name' => $file_tmp_name,
            //     'file_new_name' => $fnn,
            //     'file_extension' => $file_extension,
            //     'file_size_bytes' => $file_size_bytes,
            //     'target_dir' => $target_dir,
            //     'allowed_formats' => $arr_allowed_formats,
            // ]);
        } else {
            header("Location: $callback?upload_state=0&err=6");
            exit;

            // u::resp(0, [
            //     'err' => 'file copy to destination folder failed.',
            //     'file_tmp_name' => $file_tmp_name,
            //     'file_new_name' => $file_new_name,
            // ]);
        }
    }
}
