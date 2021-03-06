<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Session;

class Util 
{

    static function userIsAdmin(){
        $user_access_level = Session::get('user_access_level', 0);
        if($user_access_level == 100) return true;
        else return false;
    }

    static function userIsLoggedIn(){
        $user_id = Session::get('user_id', '');
        if($user_id == '') return false;
        else return true;
    }

    static function diff($strA, $strB)
    {
        // swap $strA and $strB if needed
        if (strlen($strA) < strlen($strB)) {
            $t = $strA;
            $strA = $strB;
            $strB = $t;
        }
        return substr($strA, strlen($strB));
    }
    

    static function getRootDir(){
        $dir = realpath(__dir__."/../public");
        return $dir;
    }
    
    static function getRootUrl(){
        // LARAVEL DEVELOPMENT SERVER:
        // HTTP_HOST -> localhost:8000
        // PATH_INFO -> /api/get-root-url
        // REQUEST_URI -> /api/get-root-url
        // SERVER_NAME -> 127.0.0.1
        // SERVER_PORT -> 8000
        // "DOCUMENT_ROOT": "C:\\xampp\\htdocs\\1-WebApps\\laravel-fullstack\\laravel-fullstack\\public"
        // dir "C:\\xampp\\htdocs\\1-WebApps\\laravel-fullstack\\laravel-fullstack",

        
        // APACHE:
        // HTTP_HOST -> localhost
        // REQUEST_URI -> /1-WebApps/laravel-fullstack/laravel-fullstack/public/api/get-root-url
        // DOCUMENT_ROOT -> C:/xampp/htdocs,
        // dir "C:\\xampp\\htdocs\\1-WebApps\\laravel-fullstack\\laravel-fullstack",

        
        $doc_root = realpath($_SERVER['DOCUMENT_ROOT']);
        $sfn = dirname(realpath($_SERVER['SCRIPT_FILENAME']));
        $df = Util::diff($sfn, $doc_root);
        $df = str_replace("\\","/",$df);
        $url = $_SERVER['HTTP_HOST'].$df;
        $url = str_replace("\\","/",$url);
        $url = "http://$url";

        return $url;
        // return Util::resp(1, [
        //     'doc_root'=>$doc_root,
        //     'sfn'=>$sfn,
        //     'diff'=>$df,
        //     'root-url'=>$url,
        //     // 'SERVER' => $_SERVER,
        // ]);
    }

    static function getSession($key, $default=''){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION[$key])) return $_SESSION[$key];
        else return $default;
    }

    static function setSession($key, $val){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION[$key] = $val;        
    }

    static function resp($ok = 1, $result){
        $content = ["ok" => $ok, "result" => $result];
        $status = 200;
        return (new Response($content, $status))
        ->header('Content-Type', 'application/json');
    }

    static function respAccessDenied(){
        return Util::resp(0, 'Access Denied!');
    }


    static function uploadHttpProcess(Request $req){
        
        // Processing HTTP
        // ----------------------------------------------------------
        // POST /api/upload HTTP/1.1
        // Accept:          */*
        // Accept-Encoding: gzip, deflate, br
        // Accept-Language: en-US,en;q=0.9,la;q=0.8
        // Cache-Control:   no-cache
        // Connection:      close
        // Content-Length:  218
        // Content-Type:    text/plain;charset=UTF-8
        // Cookie:          ID=id_3035829; csrftoken=z77Qspvl6tdfy90Ut7Cf5yLv1ybM06uyeTy3KAp4VHMLCtluGTEo9hlc2JVfxlrB; PHPSESSID=bb5u57bbln0hbrbdsatad40c7h
        // Host:            localhost:4200
        // Origin:          http://localhost:4200
        // Pragma:          no-cache
        // Referer:         http://localhost:4200/backend-test
        // Sec-Fetch-Dest:  empty
        // Sec-Fetch-Mode:  cors
        // Sec-Fetch-Site:  same-origin
        // User-Agent:      Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.36
        // Cookie: ID=id_3035829; csrftoken=z77Qspvl6tdfy90Ut7Cf5yLv1ybM06uyeTy3KAp4VHMLCtluGTEo9hlc2JVfxlrB; PHPSESSID=bb5u57bbln0hbrbdsatad40c7h
        
        // ------WebKitFormBoundaryRORjL9JWuJT0QspO
        // Content-Disposition: form-data; name="file0"; filename="test.txt"
        // Content-Type: text/plain
        
        // this is a test file to be uploaded.
        // ------WebKitFormBoundaryRORjL9JWuJT0QspO--
        // ----------------------------------------------------------
        

        // Test trace
        $h = $req;

        $s = strpos($h, '------WebKitFormBoundary');
        $e = strpos($h, '------WebKitFormBoundary',$s+1);
        $len = $e-$s;
        $c = substr($h, $s, $len);
        
        $s = strpos($c, "\n") + 1;
        $c = substr($c, $s);

        $fns=strpos($c, 'filename="') + 10;
        $fne=strpos($c, '"', $fns+1);
        $len = $fne - $fns;
        $fn = substr($c, $fns, $len);


        // drop line: 
        // Content-Disposition: form-data; name="file0"; filename="gradient.jpg"
        $s = strpos($c, "\n") + 1;
        $c = substr($c, $s);

        // drop line: 
        // Content-Type: image/jpeg
        $s = strpos($c, "\n") + 1;
        $c = substr($c, $s);

        // drop empty line 
        $s = strpos($c, "\n") + 1;
        $c = substr($c, $s);


        Storage::disk('local')->put('test-outputs.txt', $h);
        

        $dir_destination = storage_path("app\\uploads");

        // test:
        // Storage::disk('local')->put('out.txt', $dir_destination);
        // return Util::resp(1, 'end of test');
        //----------------------------------------------------------------


        if (!is_dir($dir_destination)){
            if (!mkdir($dir_destination, 0777, true)) {
                return Util::resp(0, "failed to create output directory");
            }
        }
        $file_destination = "$dir_destination\\$fn";
        
        // test:
        // Storage::disk('local')->put('out.txt', $file_destination);
        // return Util::resp(1, 'end of test');
        //----------------------------------------------------------------


        if (file_exists($file_destination)){
            return Util::resp(0, 'file already exists');
        }

        // test:
        // Storage::disk('local')->put('out.txt', $c);
        // Storage::disk('local')->put('out.txt', "/uploads/$fn");
        // return Util::resp(1, 'end of test');
        //----------------------------------------------------------------

        if(Storage::put("/uploads/$fn", $c)!=1){
            return Util::resp(0, 'file copy to destination failed');
        }

        return Util::resp(1, 'upload succeeded');

        // test:
        // Storage::disk('local')->put('out.txt', $r);
        // return Util::resp(1, 'end of test');
        //----------------------------------------------------------------


        // if (!isset($_FILES['fileToUpload'])) {
        //     return Util::resp(0, ['err'=>'missing file', '$_FILES'=>$_FILES]);
        // };
        
        // TEST:
        // return Util::resp(1, $_FILES);
        // if ($_FILES['fileToUpload']['name']=='') return Util::resp(0, 'missing file name');
        // if ($_FILES['fileToUpload']['type']=='') return Util::resp(0, 'missing file type');
        // if ($_FILES['fileToUpload']['tmp_name']=='') return Util::resp(0, 'missing file name');


        // $file_name = $_FILES['fileToUpload']['name'];
        // $file_type = $_FILES['fileToUpload']['type'];
        // $file_tmp_name = $_FILES['fileToUpload']['tmp_name'];
        // $error = $_FILES['fileToUpload']['error'];
        // $file_size = $_FILES['fileToUpload']['size'];
        
        // $dir_destination = storage_path("uploads/");
        // if (!is_dir($dir_destination)){
        //     if (!mkdir($dir_destination, 0777, true)) {
        //         return Util::resp(0, "failed to create output directory");
        //     }
        // }


        // $file_destination = "$dir_destination\\$file_name";
        
        // if (file_exists($file_destination)){
        //     return Util::resp(0, 'file already exists');
        // }
        // if(!copy($file_tmp_name , $file_destination)){
        //     return Util::resp(0, 'file copy to destination failed');
        // }
        // return Util::resp(1, 'upload succeeded');
    }

    static function codeToString($codeStr){
        $chars = explode(';', $codeStr);
        $s='';
        foreach($chars as $char){
          $s .= chr((int) $char);
        }
        return $s;
      }     
}
