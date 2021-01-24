@extends('layout.payroll_app')

@section('style')
{{--    <link href="{{ asset('js/jquery-ui-1.12.1/jquery-ui.css') }}" rel="stylesheet">--}}
@endsection

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-9 offset-md-1">

                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">
                        <div class="centar_horizontal">
                            <h3 class="th3"><span class="th3ex">Report - Department from {{ $super['name'] }}</span></h3>
                        </div>

                        <div class=" x_panel">
                            <div style="display: flex;">
                                <label for="department_list" style="padding-right: 10px;">Department:</label>
                                <input type="text" id="department_list" style="border-top: 1px solid #c7c7c7;    border-bottom: 1px solid #c7c7c7;    border-left: 1px solid #c7c7c7;  border-right: 0px; margin-right: 0px;  border-radius: 5px 0px 0px 5px;"/>
                                <input type="hidden" id="ruta_department_add" value="{{ route('add_department_report') }}"/>
                                <input type="hidden" id="idSuper_department_add" value="{{ $super['id'] }}"/>
                                <button type="button" id="buttonIdAddDepartment" class="btn btn-primary btn-sm" onclick="addDepartment()" style="    margin-bottom: 0px;  border-radius: 0px 5px 5px 0px;"><i class="fa fa-save"></i> Add</button>
                                <img id="imageIdGif" class="ocultar" src="{{asset('images/831.gif')}}" style="height: 35px;"/>
                            </div>
                            <hr/>
                            <div id="mensaje_id"></div>
                            @if(empty($info))
                                <h5>There are not department</h5>
                            @else
                                <h5>Departments:</h5>
                                <input type="hidden" id="id_modify_department_add" value="{{ route('modify_department_report') }}"/>
                                <div class="central">
                                    <ul style="list-style:none">
                                        @foreach($info as $inf)
                                            <li><form class="form-inline">
                                                    <div class="form-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <label for="inputName{{$inf['id']}}" style="padding-right: 0.5em;"><i class="fa fa-building-o"></i></label>
                                                            <input type="text" id="inputName{{$inf['id']}}" value="{{$inf['name']}}" class="custom-file" disabled/>
                                                        </div>
                                                        <input type="hidden" id="inputId{{$inf['id']}}" value="{{$inf['id']}}" disabled/>

                                                    </div>
                                                    <div class="form-group mx-sm-3 mb-2">
                                                        <select class="custom-select" id="inputStatus{{$inf['id']}}" disabled>
                                                            @if($inf['status'] == 'active')
                                                                <option value="active">Active</option>
                                                                <option value="inactive">Inactive</option>
                                                            @else
                                                                <option value="inactive">Inactive</option>
                                                                <option value="active">Active</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <button id="idActiveModifyButton{{$inf['id']}}" class="btn btn-success by2 " type="button" onclick="activeModifyDepartment({{$inf['id']}});"><i class="fa fa-edit"></i> Modify</button>
                                                    <button id="idModifyButton{{$inf['id']}}" class="ocultar btn btn-primary by" type="button" onclick="modifyDepartment({{$inf['id']}});"><i class="fa fa-edit"></i> Modify</button>
                                                    <button id="idCloseModifyButton{{$inf['id']}}" class="ocultar btn btn-danger by" type="button" onclick="closeModifyDepartment({{$inf['id']}});"><i class="fa fa-close"></i> Cancelar</button>
                                                    <a id="idAddPayrollDepartmentButton{{$inf['id']}}" href="{{route('report_depart_add_payrolldepartment', ['id' => $inf['id']])}}" class="ocultar btn btn-warning by" type="button" >Payroll department</a>
                                                </form>
                                            </li>
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
