<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/md5.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

    <title>@yield('page_title')</title>
  </head>
  <body onload="init();">


    <div id="div_side_bar">
      <button id="btn_toggle_sidebar_1" class="btn_toggle_sidebar" style="width:100%" onclick="toggleSidebar();">
        <svg class="bi bi-list" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 013 11h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 7h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 3h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5z" clip-rule="evenodd"></path>
        </svg>        
      </button>

      <a href="/login">LOGIN</a>
      <a href="/signup">SIGN-UP</a>
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
      <img style="width:100px" src="{{ asset('img/alvand-icon.svg') }}" alt="">

      <!-- SEARCH BOX -->
      <input type="text" name="" id="txtSearch" placeholder="SEARCH POSTS, COMMENTS, ARTICLES, etc.">

      <button class="btn btn-primary" id='btnSearch' onclick="search();">
        <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"></path>
          <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"></path>
        </svg>
      </button>
      @if(Session::get('cnt')>3)
        <button class="btn btn-primary" id='btnLogin' >LOGIN</button>
      @endif
      <button class="btn btn-primary" id='btnLogin' >
        <svg class="bi bi-person-plus-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 100-6 3 3 0 000 6zm7.5-3a.5.5 0 01.5.5v2a.5.5 0 01-.5.5h-2a.5.5 0 010-1H13V5.5a.5.5 0 01.5-.5z" clip-rule="evenodd"></path>
            <path fill-rule="evenodd" d="M13 7.5a.5.5 0 01.5-.5h2a.5.5 0 010 1H14v1.5a.5.5 0 01-1 0v-2z" clip-rule="evenodd"></path>
        </svg>      
      </button>

      <!-- LOG-OUT -->
      <button class="btn btn-secondary" id='btnLog-out' >
        <svg class="bi bi-power" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M5.578 4.437a5 5 0 104.922.044l.5-.866a6 6 0 11-5.908-.053l.486.875z" clip-rule="evenodd"></path>
          <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z" clip-rule="evenodd"></path>
        </svg>        
      </button>

    </div>
    @yield('header')

    <div id='div_search_results'>

    </div>

    <div id='div_contents'>
        @yield('content')
    </div>

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
