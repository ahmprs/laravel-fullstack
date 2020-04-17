<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/md5.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>

    <title>@yield('page_title')</title>
  </head>
  <body onload="init();">


    <div id="div_side_bar">
      <button id="btn_toggle_sidebar_1" class="btn_toggle_sidebar" style="width:100%" onclick="toggleSidebar();">
        <svg class="bi bi-list" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 013 11h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 7h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 3h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5z" clip-rule="evenodd"></path>
        </svg>        
      </button>

      <a href="/sign-in">SIGN-IN</a>
      <a href="/sign-up">SIGN-UP</a>
      <a href="/home">
        HOME
      </a>
      <a href="/products">PRODUCTS</a>
      <a href="/contacts">CONTACTS</a>
      <a href="/orders">ORDERS</a>
      <a href="/customer-service">CUSTOMER-SERVICE</a>
      <a href="/offers">OFFERS</a>
      <hr>
      <a href="/about-us" class="about-us" >ABOUT US</a>
  </div>

  <div id='div_body'>
    <!-- HEADER -->
    <div id="div_header">

      <button id="btn_toggle_sidebar_2" class="btn_toggle_sidebar" onclick="toggleSidebar();">
          <svg class="bi bi-list" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 013 11h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 7h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 3h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5z" clip-rule="evenodd"></path>
          </svg>        
      </button>

      <!-- LOGO -->
      <img style="width:100px; float:right" src="{{asset('img/alvand-icon.svg')}}" alt="">

      <!-- MSG -->
      <h3 class="d-inline">Your trust is our wealth</h3>
      <br>


      <!-- SEARCH COMPONENT -->
      @component('cmp-search')
        @slot('id')
          cmp-search
        @endslot
      @endcomponent



      <!-- @if(Session::get('cnt')>3)
        <button class="btn btn-primary" id='btnLogin' >LOGIN</button>
      @endif -->
     
      
      <!-- SIGN-UP -->
      <button class="btn btn-primary" id='btnSignUp' >
        <img src="{{asset('img/sign-up-icon.svg')}}" alt="SIGN-UP">
      </button>


      <!-- LOG-OUT -->
      <button class="btn btn-secondary" id='btnLog-out' >
        <img src="{{asset('img/log-out-icon.svg')}}" alt="SIGN-OUT">
      </button>
    </div>

    @yield('header')

    <!-- SEARCH RESULTS -->
    <div id='div_search_results'></div>

    
    <!-- PAGE CONTENTS -->
    <div id='div_contents'>
        @yield('content')
    </div>

    
    <!-- PAGE FOOTER -->
    <div id="div_footer">
      <a href="/home">
        HOME
      </a>
      <span>|</span>
      <a href="/home">PRODUCTS</a>
      <span>|</span>
      <a href="/contacts">CONTACTS</a>
      <span>|</span>
      <a href="/orders">ORDERS</a>
      <span>|</span>
      <a href="/customer-service">CUSTOMER-SERVICE</a>
      <span>|</span>
      <a href="/offers">OFFERS</a>
      <span>|</span>
      <a href="/about-us">ABOUT US</a>

      <hr>
      <div class="text-left">
        <h4 class='inline'>PHONE:</h4>
        <h4 class='light-1 inline'>+(98) 123456789</h4>
        <br>
        <h4 class="inline">ADDRESS:</h4>
        <h4 class="light-2 inline">blob blob blob </h4>
        <br>
        <h4 class="inline">EMAIL:</h4>
        <h4 class="light-2 inline">blob blob blob </h4>
      </div>
          @yield('footer')
    </div>
  </div>
  </body>
</html>
