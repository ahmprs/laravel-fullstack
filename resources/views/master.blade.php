<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/md5.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

    <title>@yield('page_title')</title>
  </head>
  <body onload="init();">
    <div id="div_side_bar">
      <a href="/login">LOGIN</a>
      <a href="/signup">SIGNUP</a>
      <a href="/home">HOME</a>
      <a href="/products">PRODUCTS</a>
      <a href="/contacts">CONTACTS</a>
      <a href="/orders">ORDERS</a>
      <a href="/customer-service">CUSTOMER-SERVICE</a>
      <a href="/offers">OFFERS</a>
      <hr>
      <a href="/about-us">ABOUT US</a>
  </div>

  <div id='div_body'>
    <!-- HEADER -->
    <div id="div_header">
      <input type="text" name="" id="txtSearch" placeholder="SEARCH POSTS, COMMENTS, ARTICLES, etc.">
      <button class="btn btn-primary" id='btnSearch' onclick="search();">FIND</button>
      @if(Session::get('cnt')>3)
        <button class="btn btn-primary" id='btnLogin' >LOGIN</button>
      @endif

      <button class="btn btn-primary" id='btnLogin' >SIGNUP</button>
      <button class="btn btn-primary" id='btnLogin' >LOG-OUT</button>

    </div>
    @yield('header')

    <div id='div_search_results'>

    </div>

    <div id='div_contents'>
        @yield('content')
    </div>

    <div id="div_footer">
      <a href="/home">HOME</a>
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
