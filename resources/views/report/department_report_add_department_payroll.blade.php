@extends('layout.payroll_app')

@section('style')

@endsection

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">
                        <div class="centar_horizontal">
                            <h3 class="th3">{{ $supermarket->name }} - Add Department Report Department Payroll</h3>
                        </div>
                        <div class="row">
                            <div class="col-sm-8 offset-md-2">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2><i class="fa fa-building-o"></i> Department <small> {{$report_depart->name}}</small></h2>
                                        <ul class="nav navbar-right panel_toolbox"><li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li></ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <br>
                                        <form method="post" action="{{ route('link_report_payroll_department') }}">
                                            @csrf
                                            <h3>Payroll Department</h3>
                                            <input type="hidden" name="supermaket_id" value="{{$supermarket->id}}">
                                            <input type="hidden" name="report_department_id" value="{{$report_depart->id}}">
                                            @foreach($payroll_depart as $pd)
                                            <div class="form-group form-check">
                                                <input type="hidden" class="form-control" name="idDepartmentPayroll_{{$pd->id}}" id="idDepartmentPayroll_{{$pd->id}}" value="{{$pd->id}}">
                                                @if(array_key_exists($pd->id, $report_payroll_dep))
                                                    <input type="checkbox" class="form-check-input" name="departmentPayroll_{{$pd->id}}" id="departmentPayroll_{{$pd->id}}" checked>
                                                @else
                                                    <input type="checkbox" class="form-check-input" name="departmentPayroll_{{$pd->id}}" id="departmentPayroll_{{$pd->id}}">
                                                @endif
                                                <label class="form-check-label" for="departmentPayroll_{{$pd->id}}">{{$pd->name}}</label>
                                            </div>
                                            @endforeach
                                            <hr/>
                                            <div class="float-right">
                                                <a href="{{ route("ver_reporte_department", ["id_supermarket" => $supermarket->id]) }}" class="btn btn-danger by"><i class="fa fa-close"></i> Cancel</a>
                                                <button type="submit" class="btn btn-primary by"><i class="fa fa-edit"></i> Save</button>
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
    <script src="{{ asset('js/general_report.js') }}"></script>
@endpush
