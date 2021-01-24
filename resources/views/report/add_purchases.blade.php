@extends('layout.payroll_app')

@section('style')
    <link href="{{ asset('css/gijgo.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<style>
.right{background: white;}
.form-control{padding-right: 2.5em;}
</style>
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body justify-content-center">
                        <div class="centar_horizontal"><h3 class="th3"><span class="th3ex">{{$supermarket['name']}} - Add Purchase</span></h3>  </div>
                        <div class="row justify-content-center ">
                            <div class="col-sm-10 col-md-8">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2><i class="fa fa-shopping-cart"></i> Purchase Supermarket</h2>
                                        <ul class="nav navbar-right panel_toolbox"><li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li></ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">

                                        <form method="post" action="{{ route('adding_purchase') }}" class="form-horizontal form-label-left">
                                            @csrf
                                            <input type="hidden" id="inputIdSupermarket" name="inputIdSupermarket" value="{{$supermarket['id']}}">
                                            <div class="form-group row">
                                                <label  class="control-label col-md-2 col-sm-2" for="inputDate">Date:</label>
                                                <div class="col-md-10 col-sm-10 ">
                                                    <input type="text" class="form-control" required id="inputDate" name="inputDate" value="" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-md-2 col-sm-2" for="inputAmount">Amount:</label>
                                                <div class="col-md-10 col-sm-10 ">
                                                    <input type="number" class="form-control" id="inputAmount" name="inputAmount" step="0.01" value="" required>
                                                    <span class="fa fa-bar-chart form-control-feedback right" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-2 col-sm-2" for="inputDepartment">Department:</label>
                                                <div class="col-md-10 col-sm-10 ">
                                                    <select class="form-control" id="inputDepartment" name="inputDepartment">
                                                        @foreach($info as $inf)
                                                        <option value="{{$inf->id}}">{{$inf->name}}</option>
                                                        @endforeach
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
