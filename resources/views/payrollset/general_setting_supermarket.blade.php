@extends('layout.payroll_app')

@section('style')
    <link href="{{ asset('js/jquery-ui-1.12.1/jquery-ui.css') }}" rel="stylesheet">
@endsection

@section('content')
<style>
.right{background: white;}
.form-control{padding-right: 2.5em;}
.th3{padding-top: 1.5em;}
.th3ex{line-height: 3rem;}
.x_panel{max-width: 730px;}
</style>
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                    
                    <div class="panel-body">
                        <div class="centar_horizontal"><h3 class="th3"><span class="th3ex">General setting supermarket {{$supermarket['name']}}</span></h3></div>
                        <div class="row" style="justify-content: center;">
                          <div class="col-8" style="display: flex; justify-content: center;">
                           <div class="x_panel">
                             <div class="x_title">
                               <h2><i class="fa fa-shopping-cart"></i> General Supermarket</h2>
                               <ul class="nav navbar-right panel_toolbox"><li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li></ul>
                               <div class="clearfix"></div>
                             </div>
                             <div class="x_content">

                            <form method="post" action="{{ route('enter_general_setting', ['id_supermarket' => session()->get('supermarket_id')]) }}" class="form-horizontal form-label-left">
                                @csrf
                                <input type="hidden" id="inputId" name="inputId" value="<?php if(!empty($info)){echo $info[0]['id'];} else{echo '0';} ?>">
                                <div class="form-group row">
                                    <label  class="control-label col-md-3 col-sm-12" for="inputRegularHours">Regular Hours:</label>
                                      <div class="col-md-9 col-sm-12 ">
                                    <input type="number" class="form-control" required id="inputRegularHours" name="inputRegularHours" value="@php
                                        if(!empty($info))
                                        {
                                            echo $info[0]['regular_hours'];
                                        }
                                    @endphp">
                                      <span class="fa fa-clock-o form-control-feedback right" aria-hidden="true"></span>
                                  </div>
                                </div>


                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-12" for="inputPTO">PTO:</label>
                                        <div class="col-md-9 col-sm-12 ">
                                    <input type="number" class="form-control" id="inputPTO" name="inputPTO" value="@php
                                        if(!empty($info))
                                        {
                                            echo $info[0]['pto_hours'];
                                        }
                                    @endphp">
                                      <span class="fa fa-bar-chart form-control-feedback right" aria-hidden="true"></span>
                                </div>
                              </div>
                                  <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-12" for="inputPOverHour">Porcentage over hours:</label>
                                       <div class="col-md-9 col-sm-12 ">
                                    <input type="number" class="form-control" id="inputPOverHour" name="inputPOverHour" value="@php
                                        if(!empty($info))
                                        {
                                            echo $info[0]['porcentage'];
                                        }
                                    @endphp">
                                      <span class="fa fa-bar-chart form-control-feedback right" aria-hidden="true"></span>
                                </div>
                              </div>
                                  <hr/>
                                <div class="float-right">
                                    <a href="{{ url('Dashboard_payroll') }}" class="btn btn-danger by"><i class="fa fa-close"></i>Cancel</a>
                                    <button type="submit" class="btn btn-primary by"><i class="fa fa-edit"></i>Enter</button>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/supermarket.js') }}"></script>
@endpush
