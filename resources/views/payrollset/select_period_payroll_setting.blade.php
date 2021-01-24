@extends('layout.payroll_app')

@section('style')
    <link href="{{ asset('css/gijgo.min.css') }}" rel="stylesheet">
    <style>
     .btn-outline-secondary{
       margin-bottom: 0px;
     }
     .disabled{
       background: lightgray;
       border: 1px solid white;
     }
     .gj-cursor-pointer > div{
       font-weight: 700;
     }
     .gj-cursor-pointer:hover > div{
       background: blue !important;
       color: white !important;
       text-shadow: 1px 1px 2px black;
     }
    </style>
@endsection

@section('content')
<style>
.th3{padding-top: 1.5em;}
.th3ex{line-height: 3rem;}
.x_panel{max-width: 730px;}
.panel-body {padding-bottom: 0px;}
</style>
    <div class="">
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-11 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-body">
                 <div class="centar_horizontal"><h3 class="th3"><span class="th3ex">Select period payroll from {{ $supermarket['name'] }}</span></h3></div>
                 <div class="row" style="justify-content:center; padding-right: 2em; padding-left: 2em;">
                   <div class="x_panel">
                      <div class="x_title">
                        <h2><i class="fa fa-calendar"></i> Period</h2>
                        <ul class="nav navbar-right panel_toolbox"><li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li></ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <br>
                        <form method="get" action="{{ route('set_payroll_setting', ['id_supermarket' => $supermarket['id']]) }}" class="form-horizontal form-label-left">
                            @csrf
                              <div class="form-group row">
                                <input id="inputDate"  placeholder="Date..." name="inputDate" autocomplete="off"/>
                              </div>
                            <hr>
                            <div class="float-right">
                                <a href="{{ url('Dashboard_payroll') }}" class="btn btn-danger by"><i class="fa fa-close"></i> Cancel</a>
                                <button type="submit" class="btn btn-primary by"><i class="fa fa-edit"></i>  Enter</button>
                            </div>
                            <div class="clear"></div>
                        </form>
                      </div>
                    </div>
                 </div>
              </div>
                <div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
           </div>
             <div class="panel panel-default">
                   <div class="panel-body">
                       <div class="row" style="justify-content:center; padding-right: 2em; padding-left: 2em;">
                           <div class="x_panel">
                               <div class="x_title">
                                   <h2><i class="fa fa-calendar"></i> Last 10 period payroll from {{ $supermarket['name'] }}</h2>
                                   <ul class="nav navbar-right panel_toolbox"><li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li></ul>
                                   <div class="clearfix"></div>
                               </div>
                               <div class="x_content selecblo">
                                   <br>
                                   @if($payroll->isNotEmpty())
                                       <ul>
                                           @foreach($payroll as $p)
                                               <li><a href="javascript:void(0);" onclick="buscarPeriodoByClick('{{ $p->period_starting }}');"><i class="fa fa-calendar"></i> {{ $p->period_starting }}</a></li>
                                           @endforeach
                                       </ul>
                                   @endif
                               </div>
                           </div>
                       </div>
                   </div>
                   <div>
                       @if ($errors->any())
                           <div class="alert alert-danger">
                               <ul>
                                   @foreach ($errors->all() as $error)
                                       <li> {{ $error }}</li>
                                   @endforeach
                               </ul>
                           </div>
                       @endif
                   </div>
               </div>


        </div>



      </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('js/gijgo.min.js') }}"></script>
<script src="{{ asset('js/periodo_payroll.js') }}"></script>
    <script>
     $( function() {
              $('#inputDate').datepicker({ uiLibrary: 'bootstrap4',  disableDaysOfWeek: [1, 2, 3, 4, 5, 6] });});

    </script>
@endpush
