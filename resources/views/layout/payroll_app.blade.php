<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Payroll Module') }}</title>

        <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
        <link href="{{ asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
        <link href="{{ asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">

        <style>
         body{background: #d2dc8f;}
         .dropdown-menu {top:20px !important; width: 130px !important; box-shadow: 1px 2px 3px black !important;}
       </style>
      @yield('style')
</head>
<body class="nav-md">
 <div class="container body">
    <div class="main_container">
                    @guest
                       @include('layout.cabecerabill.invitado')
                    @else
                       @include('layout.cabecerabill.autenticado')
                    @endguest
        <div class="right_col" role="main">
            @yield('content')
        </div>
            @include('layout.foot.invitado')
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->


<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>

<!-- Scripts -->
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>
<script src="{{ asset('vendors/gauge.js/dist/gauge.min.js') }}"></script>
<script src="{{ asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('vendors/skycons/skycons.js') }}"></script>

<!-- Custom Theme Scripts -->

<!-- General Functions-->
<script src="{{ asset('build/js/custom.js') }}"></script>
<script src="{{ asset('js/functions.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

<script type="text/javascript">
   $(document).ready(function() {
        $("#modal").click(function(){
          Swal.fire({
                title: 'Ready to Leave?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes!'
                   }).then((result) => {if (result.value) {$("#logout-form").submit();}});
        });
        /*los tooltips */
        $('[data-toggle="tooltip"]').tooltip();

   });

</script>
@stack('scripts')
</body>
</html>
