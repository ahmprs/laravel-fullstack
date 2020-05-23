<?php
    use App\Util as u;
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{$root_url}}/main-css">

    <script>
      var root_url = "{{$root_url}}";
    </script>

    <!-- <script>var exports = {"__esModule": true};</script> -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/md5.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    
    <!-- PUTS JAVASCRIPTS -->
    <?php 
        function putJavaScripts(){
          // $js_dir = realpath ($_SERVER['DOCUMENT_ROOT']."/js/app/");
          $js_dir = realpath (__dir__."/../../../public/js/app/");
            $arr = scandir($js_dir,0);
            $brr = [];
            for($i=0;$i<count($arr);$i++){
                $fn=$js_dir."/".$arr[$i];
                if(!is_file($fn)) continue;
                $inf = pathinfo($fn);
                if (strtolower($inf["extension"]) !='js') continue;
                $brr[]=$arr[$i];
            }
    
            for($i=0;$i<count($brr);$i++){
                $src = "js/app/".$brr[$i];
                $src = asset($src);
                echo("<script src= '$src'></script>");
            }
        }
        putJavaScripts();
    ?>
    
    <title>@yield('page_title')</title>
  </head>
  <body onload="init();">


    <div id="div_side_bar" style="display:none; overflow: auto;" >
      <button id="btn_toggle_sidebar_1" class="btn_toggle_sidebar" style="width:100%" onclick="toggleSidebar();">
        <svg class="bi bi-list" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 013 11h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 7h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 3h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5z" clip-rule="evenodd"></path>
        </svg>
      </button>

      <a href="{{$root_url}}/sign-in">SIGN-IN</a>
      <a href="{{$root_url}}/sign-up">SIGN-UP</a>
      <a href="{{$root_url}}/home">
        HOME
      </a>
      <a href="{{$root_url}}/products">PRODUCTS</a>
      <a href="{{$root_url}}/contacts">CONTACTS</a>
      <a href="{{$root_url}}/orders">ORDERS</a>
      <a href="{{$root_url}}/customer-service">CUSTOMER-SERVICE</a>
      <a href="{{$root_url}}/offers">OFFERS</a>
      @if(u::userIsAdmin())
      <a href="{{$root_url}}/admin-area">ADMIN</a>
      @endif
      <hr>
      <a href="{{$root_url}}/about-us" class="about-us" >ABOUT US</a>
    </div>

    <!-- HEADER -->
    <div id="div_header">
        <button id="btn_toggle_sidebar_2" class="btn_toggle_sidebar" onclick="toggleSidebar();">
            <svg class="bi bi-list" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 013 11h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 7h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 3h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5z" clip-rule="evenodd"></path>
            </svg>        
        </button>

        <!-- LOGO -->
        <img id="website_icon" style="width:65px; float:right" src="{{asset('img/alvand-icon.svg')}}" alt="alvand-softs-logo">

        <!-- MSG -->
        <h3 class="d-inline">
          <em style="font-family:Times New Roman;">
            <span style="color:rgb(124, 163, 212); letter-spacing: 5px;">alvand</span>
            <span style="color:rgb(212, 203, 124); letter-spacing: 5px;">softs</span>
            <span style="color:rgb(124, 163, 212);">.</span> 
            <span style="color:rgb(124, 163, 212);">com</span> 
          </em>
        </h3>
        <br>

        <!-- SIGN-UP -->
        <!-- <button class="btn btn-primary" id='btnSignUp' >
          <img src="{{asset('img/sign-up-icon.svg')}}" alt="SIGN-UP">
        </button> -->


        <!-- LOG-OUT -->
        <!-- <button class="btn btn-secondary" id='btnLog-out' >
          <img src="{{asset('img/log-out-icon.svg')}}" alt="SIGN-OUT">
        </button> -->
      </div>

  <div id='div_body'>

    <!-- SEARCH RESULTS -->
    <!-- <div id='div_search_results'></div> -->

    
    <!-- PAGE CONTENTS -->
    <div id='div_contents'>
        @yield('content')
    </div>

    
    <!-- PAGE FOOTER -->
    <div id="div_footer">
      <a href="{{$root_url}}/home">
        HOME
      </a>
      <span>|</span>
      <a href="{{$root_url}}/products">PRODUCTS</a>
      <span>|</span>
      <a href="{{$root_url}}/contacts">CONTACTS</a>
      <span>|</span>
      <a href="{{$root_url}}/orders">ORDERS</a>
      <span>|</span>
      <a href="{{$root_url}}/customer-service">CUSTOMER-SERVICE</a>
      <span>|</span>
      <a href="{{$root_url}}/offers">OFFERS</a>
      <span>|</span>
      <a href="{{$root_url}}/about-us">ABOUT US</a>

      <hr>
      <div class="text-left">
        <h4 class='inline'>PHONE:</h4>
        <h4 class='light-1 inline'>
        <?php
          function getSettings($stg_key){
            $records = DB::table('tbl_settings')
            ->where('stg_key','=',"$stg_key")
            ->where('user_id','=','0')
            ->get();
            if(count($records)>0) return $records[0]->stg_val;
            else return '[]';
          }
          echo getSettings('phone');
        ?>

        </h4>
        <br>
        <h4 class="inline">ADDRESS:</h4>
        <h4 class="light-2 inline">
        <?php
          echo getSettings('address');
        ?>
        </h4>
        <br>
        <h4 class="inline">EMAIL:</h4>
        <h4 class="light-2 inline">
        <?php
          echo getSettings('email');
        ?>
        </h4>
      </div>
    </div>
  </div>
  </body>
</html>
