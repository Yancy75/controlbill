@extends('layout.payroll_app')

@section('style')
    <link href="{{ asset('css/gijgo.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">
                        <div class="centar_horizontal"><h3 class="th3">{{$supermarket['name']}} - Modify Purchase</h3>  </div>
                        <div class="row">
                            <div class="col-sm-8 offset-md-2">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2><i class="fa fa-shopping-cart"></i> Purchase <small> Supermarket</small></h2>
                                        <ul class="nav navbar-right panel_toolbox"><li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li></ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">

                                        <form method="post" action="{{ route('modifying_purchase', ["id_supermarket" => $supermarket['id']]) }}" class="form-horizontal form-label-left">
                                            @csrf
                                            <input type="hidden" id="inputIdSupermarket" name="inputIdSupermarket" value="{{$supermarket['id']}}">
                                            <input type="hidden" id="inputIdPurchase" name="inputIdPurchase" value="{{$info['id']}}">
                                            <div class="form-group row">
                                                <label  class="control-label col-md-2 col-sm-2" for="inputDate">Date:</label>
                                                <div class="col-md-10 col-sm-10 ">
                                                    <input type="text" class="form-control" required id="inputDate" name="inputDate" value="{{$info['date_show']}}" autocomplete="off">
                                                    <span class="fa fa-clock-o form-control-feedback right" aria-hidden="true"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-md-2 col-sm-2" for="inputAmount">Amount:</label>
                                                <div class="col-md-10 col-sm-10 ">
                                                    <input type="number" class="form-control" id="inputAmount" name="inputAmount" step="0.01" value="{{$info["amount"]}}" required>
                                                    <span class="fa fa-bar-chart form-control-feedback right" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-2 col-sm-2" for="inputDepartment">Department:</label>
                                                <div class="col-md-10 col-sm-10 ">
                                                    <select class="form-control" id="inputDepartment" name="inputDepartment">
                                                        <option value="{{$info['report_department_id']}}">{{$info['depa_name']}}</option>
                                                        @foreach($department as $dep)
                                                            @if($dep['id'] != $info['report_department_id'])
                                                            <option value="{{$dep['id']}}">{{$dep['name']}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <span class="fa fa-bars form-control-feedback right" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-2 col-sm-2" for="inputStatus">Status:</label>
                                                <div class="col-md-10 col-sm-10 ">
                                                    <select class="form-control" id="inputStatus" name="inputStatus">
                                                        <option value="{{$info['status']}}">{{$info['status']}}</option>
                                                        @if($info['status'] == "active")
                                                            <option value="inactive">inactive</option>
                                                        @else
                                                            <option value="active">active</option>
                                                        @endif
                                                    </select>
                                                    <span class="fa fa-bars form-control-feedback right" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="float-right">
                                                <a href="{{ route("view_purchase", ["id" => $supermarket['id']]) }}" class="btn btn-danger by"><i class="fa fa-close"></i>Cancel</a>
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
    {{--    <script src="{{ asset('js/supermarket.js') }}"></script>--}}
    <script src="{{ asset('js/gijgo.min.js') }}"></script>
    <script>
        $( function() {
            $('#inputDate').datepicker({ uiLibrary: 'bootstrap4'});});
    </script>
@endpush
