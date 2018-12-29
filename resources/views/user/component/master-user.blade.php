<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Bootshop online Shopping cart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <!--Less styles -->
  <!-- Other Less css file //different less files has different color scheam
  <link rel="stylesheet/less" type="text/css" href="themes/less/simplex.less">
  <link rel="stylesheet/less" type="text/css" href="themes/less/classified.less">
  <link rel="stylesheet/less" type="text/css" href="themes/less/amelia.less">  MOVE DOWN TO activate
-->
<!--<link rel="stylesheet/less" type="text/css" href="themes/less/bootshop.less">
<script src="themes/js/less.js" type="text/javascript"></script> -->

<!-- Bootstrap style -->
<link id="callCss" rel="stylesheet" href="{{ asset('shop/themes/bootshop/bootstrap.min.css') }}" media="screen"/>
<link href="{{ asset('shop/themes/css/base.css') }}" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->
<link href="{{ asset('shop/themes/css/bootstrap-responsive.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('shop/themes/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
<!-- Google-code-prettify -->
<link href="{{ asset('shop/themes/js/google-code-prettify/prettify.css') }}" rel="stylesheet"/>
<!-- fav and touch icons -->
<link rel="shortcut icon" href="{{ asset('shop/themes/images/ico/favicon.ico') }}">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('shop/themes/images/ico/apple-touch-icon-144-precomposed.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('shop/themes/images/ico/apple-touch-icon-114-precomposed.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('shop/themes/images/ico/apple-touch-icon-72-precomposed.png') }}">
<link rel="apple-touch-icon-precomposed" href="{{ asset('shop/themes/images/ico/apple-touch-icon-57-precomposed.png') }}">
<style type="text/css" id="enject"></style>
</head>
<body>
  <div id="header">
    <div class="container">
      <div id="welcomeLine" class="row">
        @if(\Auth::guest())
        <div class="span12">
          <div class="pull-right">
            <a href="{{ route('show-cart') }}"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [{{ \Cart::getContent()->count() }}] item(s) in your chart</span> </a>
          </div>
        </div>
        @else
        <div class="span6">Welcome!<strong>
          {{ \Auth::user()->full_name }}
        </strong></div>
        <div class="span6">
          <div class="pull-right">
            <a href="{{ route('show-cart') }}"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [{{ \Cart::getContent()->count() }}] item(s) in your chart</span> </a>
          </div>
        </div>
        @endif

      </div>
      <!-- Navbar ================================================== -->
      <div id="logoArea" class="navbar">
        <a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <div class="navbar-inner">
          <a class="brand" href="{{ url('/') }}"><img src="{{ asset('logo/logo.png') }}" width="50" height="50" alt="Bootsshop"/></a>
          <form class="form-inline navbar-search">
            <input id="srchFld" class="srchTxt" type="text" />
            <select class="srchTxt">
              <option value="0">All</option>
              @foreach(\App\Category::all() as $data)
                <option value="{{ $data->id }}">{{ $data->name }}</option>
              @endforeach
            </select>
            <button type="button" id="submitButton" class="btn btn-primary">Go</button>
          </form>
          <ul id="topMenu" class="nav pull-right">

            @if(\Auth::guest())
            <li class=""><a href="{{ route('register') }}">Register</a></li>
            <li class="">
              <a href="{{ url('/login') }}" role="button" style="padding-right:0"><span class="btn btn-large btn-success">Login</span></a>
            </li>
            @else
            <li class=""><a href="contact.html">Profile</a></li>
            <li class=""><a href="{{ route('confirm-payment') }}">Confirm Payment</a></li>
            <li class="">
              <a href="{{ route('logout') }}" role="button" style="padding-right:0"><span class="btn btn-large btn-success">Logout</span></a>
            </li>
            @endif

          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Header End====================================================================== -->
  @yield('slider')
  <div id="mainBody">
    <div class="container">
      <div class="row">
        <!-- Sidebar ================================================== -->
        <div id="sidebar" class="span3">
          <div class="well well-small"><a id="myCart" href="{{ route('show-cart') }}"><img src="{{ asset('shop/themes/images/ico-cart.png') }}" alt="cart">[{{ \Cart::getContent()->count() }}] item(s) in your chart </a></div>
          <ul id="sideManu" class="nav nav-tabs nav-stacked">

            <li class=""><a> Categories</a>
              <ul style="display:block">
                @foreach(\App\Category::all() as $data)
                  <li><a href="{{ route('categoryitem',[$data->id]) }}"><i class="icon-chevron-right"></i>{{ $data->name }}</a></li>
                @endforeach
              </ul>
            </li>
          </ul>
          <br/>
        </div>
        <!-- Sidebar end=============================================== -->
        @yield('content')
      </div>
    </div>
  </div>
  <!-- Footer ================================================================== -->
  <div  id="footerSection">
    <div class="container">
      <div class="row">
        <div id="socialMedia" class="span3 pull-right">
          <h5>SOCIAL MEDIA </h5>
          <a href="#"><img width="60" height="60" src="{{ asset('shop/themes/images/facebook.png') }}" title="facebook" alt="facebook"/></a>
          <a href="#"><img width="60" height="60" src="{{ asset('shop/themes/images/twitter.png') }}" title="twitter" alt="twitter"/></a>
          <a href="#"><img width="60" height="60" src="{{ asset('shop/themes/images/youtube.png') }}" title="youtube" alt="youtube"/></a>
        </div>
      </div>

    </div><!-- Container End -->
  </div>
  <!-- Placed at the end of the document so the pages load faster ============================================= -->

  <script src="{{ asset('shop/themes/js/jquery.js') }}" type="text/javascript"></script>
  <script src="{{ asset('shop/themes/js/bootstrap.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('shop/themes/js/google-code-prettify/prettify.js') }}"></script>

  <script src="{{ asset('shop/themes/js/bootshop.js') }}"></script>
  <script src="{{ asset('shop/themes/js/jquery.lightbox-0.5.js') }}"></script>
  @yield('custom-script')
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    });

    $("#submitButton").click(function(){
      var name,categ = $(".srchTxt :selected").val();
      if($("#srchFld").val() == "")
      {
        name = "0";
      }
      else {
        name = $("#srchFld").val();
      }
      if(flag == 0)
      {
        window.location.href = 'search/'+name+'/'+categ;
      }
      else if(flag == 1)
      {
        window.location.href = '../../search/'+name+'/'+categ;
      }
      else if(flag == 2)
      {
        window.location.href = '../search/'+name+'/'+categ;
      }

    });
  </script>
  <!-- Themes switcher section ============================================================================================= -->
  <div id="secectionBox">
    <link rel="stylesheet" href="{{ asset('shop/themes/switch/themeswitch.css') }}" type="text/css" media="screen" />
    <script src="{{ asset('shop/themes/switch/theamswitcher.js') }}" type="text/javascript" charset="utf-8"></script>
</body>
</html>
