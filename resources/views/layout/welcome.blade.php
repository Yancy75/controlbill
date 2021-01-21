<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/Goldeniconm.png') }}" type="image/ico" />
    <!--<title>{{ config('app.name', 'Golden Farms') }}</title>-->
      <title>Golden Farms</title>

    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">


    <!-- Custom Theme Style -->
    <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
    <style>
    /*  body{overflow-x: hidden; background-image: url(images/fondo.jpg); background-size: cover;}*/
    body{overflow-x: hidden; background-image: url(images/fondo2.jpg); background-size: cover; background-position: center;}
    /*  body{overflow-x: hidden; background-image: linear-gradient(to bottom right, #ccc, #f8f9fa);}*/
     .right_col {margin-left: 0px !important;   background: transparent !important;}
      @media (max-width: 991px){.nav-md .container.body .right_col, .nav-md .container.body .top_nav { width: auto; margin-left: 230px; }    }
     .nav_title{width: 100%; position: fixed; box-shadow: 1px 3px 6px black;}
     .nav_menu{box-shadow: 1px 3px 6px black;}
     .site_title{transition: 0.3s all;}
     .centrado2{display: flex; justify-content: center; align-items: center;}
     @media only screen and (max-width: 600px) {.site_title{font-size: 18px;}}
     @media only screen and (min-width: 600px) {.site_title{font-size: 18px;}}
     @media only screen and (min-width: 768px) {.site_title{font-size: 22px;}}
    </style>
</head>
<body class="nav-md footer_fixed">
  <div class="container body">
    <div class="main_container">
       @include('layout.cabecera.invitado')
      <div class="right_col centrado2" role="main">
        @yield('content')
      </div>
      @include('layout.foot.invitado')
    </div>
</div>

<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>
<script src="{{ asset('vendors/gauge.js/dist/gauge.min.js') }}"></script>
<script src="{{ asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('vendors/skycons/skycons.js') }}"></script>
<!-- Custom Theme Scripts -->
<script src="{{ asset('build/js/custom.min.js') }}"></script>
<!-- General Functions-->

<script src="{{ asset('js/functions.js') }}"></script>
@stack('scripts')
</body>
</html>
