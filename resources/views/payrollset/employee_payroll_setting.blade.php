@extends('layout.payroll_app')

@section('style')
    <style>
    .form-control-plaintext{padding-top: 1px; padding-left: 18px; font-weight: 700; text-decoration: underline;}
    </style>
@endsection

@section('content')
    <div class="">

        <div class="row">
            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                   <div class="panel-body">
                        <div class="centar_horizontal">
                            <h3 class="th3">Payroll setting {{$employee['name']}} {{$employee['last_name']}}</h3>
                            <div class="row">
                                <div class="col-sm-10 offset-md-2">
                                 <div class="x_panel">
                                   <div class="x_title">
                                     <h2><i class="fa fa-money"></i> Payroll<small> Employee</small></h2>
                                         <ul class="nav navbar-right panel_toolbox"><li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li></ul>
                                     <div class="clearfix"></div>
                                   </div>
                                      <div class="x_content">
                            <form method="post" action="{{ route('enter_employee_payroll_setting') }}">
                                @csrf
                                <input type="hidden" id="porcentaje_overtime" value="{{ $general[0]['porcentage'] }}">
                                <input type="hidden" id="inputId" name="inputId" value="@php
                                    if(!empty($info)){echo $info[0]['id'];}
                                    else{echo '0';}
                                @endphp">
                                <input type="hidden" id="inputIdEmployee" name="inputIdEmployee" value="{{ $employee['id'] }}">
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputPayHours">Hourly Rate$:</label>
                                    <div class="col-md-10 col-sm-10 ">
                                    <input type="text" class="form-control" id="inputPayHours" name="inputPayHours" value="@php
                                        if(!empty($info)){echo $info[0]['pay_hour'];} @endphp"
                                        @if($view_modify == 'v')
                                           disabled
                                        @endif
                                    onkeyup="calcularOvertimeEnSettingEmployee();" autocomplete="off">
                                        <span class="fa fa-clock-o form-control-feedback right" aria-hidden="true"></span>
                                      </div>
                                </div>

                                <div id="overtime_id" class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputOvertime">Overtime$:</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <input  type="text" class="form-control-plaintext" id="inputOvertime" name="inputOvertime" value="@php
                                                if(!empty($info))
                                                {echo $info[0]['pay_hour'] + (($info[0]['pay_hour'] * $general[0]['porcentage'])/100);}
                                            @endphp" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputPTO">PTO:</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <input  type="text" class="form-control-plaintext" id="inputPTO" name="inputPTO" value="@php
                                            if(!empty($info))
                                            {
                                                if($info[0]['pto_status'] == 'active')
                                                {
                                                    echo $general[0]['pto_hours'] - $info[0]['pto_accumulate_yearly'];
                                                }
                                                elseif($info[0]['pto_status'] == 'inactive')
                                                {
                                                    echo 'Inactive until '.$pto_date_activation;
                                                }
                                            }
                                        @endphp" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputTypeSalary">Type of Salary:</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <select class="form-control" id="inputTypeSalary" name="inputTypeSalary"
                                            @if($view_modify == 'v')
                                                disabled
                                            @endif
                                        >
                                            @if(empty($info))
                                                <option value="hourly">Hourly Wage</option>
                                                <option value="salary">Salary Wage</option>
                                            @else
                                                <option value="{{$info[0]->salary_type}}">
                                                    {{ ucwords($info[0]->salary_type)." Wage" }}
                                                </option>
                                                @if($info[0]->salary_type == 'hourly')
                                                    <option value="salary">Salary Wage</option>
                                                @elseif($info[0]->salary_type == 'salary')
                                                    <option value="hourly">Hourly Wage</option>
                                                @endif
                                            @endif
                                        </select>
                                        <span class="fa fa-bars form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div class="form-group row salary_class_ocultar">
                                    <label class="control-label col-md-2 col-sm-2" for="inputSalaryExcept">Salary Excempt:</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <select class="form-control" id="inputSalaryExcept" name="inputSalaryExcept"
                                            @if($view_modify == 'v')
                                                disabled
                                            @endif
                                        >
                                            @if(empty($info))
                                                <option value="excempt">Excempt</option>
{{--                                                <option value="no except">No Except</option>--}}
                                            @else
                                                <option value="{{$info[0]->salary_except}}">
                                                    {{ ucwords($info[0]->salary_except)}}
                                                </option>
                                                @if($info[0]->salary_except == 'excempt' )
{{--                                                    <option value="no except">Non-Excempt</option>--}}
                                                @elseif($info[0]->salary_except == 'no except')
                                                    <option value="excempt">Excempt</option>
                                                @else
                                                    <option value="excempt">Excempt</option>
{{--                                                    <option value="no except">No Except</option>--}}
                                                @endif
                                            @endif
                                        </select>
                                        <span class="fa fa-bars form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div class="form-group row salary_class_ocultar">
                                    <label class="control-label col-md-2 col-sm-2" for="inputHoursToCalculatedSalary">Hours:</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <input type="text" class="form-control" id="inputHoursToCalculatedSalary" name="inputHoursToCalculatedSalary" value="@php
                                            if(!empty($info)){echo $info[0]['hours_calculated_salary'];} @endphp"
                                               @if($view_modify == 'v')
                                               disabled
                                               @endif
                                               onkeyup="calcularValorHorasPorSalario();">
                                        <span class="fa fa-clock-o form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div class="form-group row salary_class_ocultar">
                                    <label class="control-label col-md-2 col-sm-2" for="inputContractHours">Salary $:</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <input type="text" class="form-control" id="inputContractHours" name="inputContractHours" value="@php
                                            if(!empty($info)){echo $info[0]['contract_hours'];} @endphp"
                                            @if($view_modify == 'v')
                                               disabled
                                            @endif
                                        onkeyup="calcularValorHorasPorSalario();">
                                        <span class="fa fa-clock-o form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputOnBook">Payroll Status:</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <select class="form-control" id="inputOnBook" name="inputOnBook"
                                            @if($view_modify == 'v')
                                                disabled
                                            @endif
                                        >
                                            @if(empty($info))
                                                <option value="on book">On Books</option>
                                                <option value="semi">Partial On Books</option>
                                                <option value="none">No On Books</option>
                                            @else
                                                <option value="{{$info[0]->on_book}}">
                                                    {{ ucwords($info[0]->on_book)}}
                                                </option>
                                                @if($info[0]->on_book == 'on book' )
                                                    <option value="semi">Partial On Books</option>
                                                    <option value="none">No On Books</option>
                                                @elseif($info[0]->on_book == 'semi')
                                                    <option value="on book">On Books</option>
                                                    <option value="none">No On Books</option>
                                                @elseif($info[0]->on_book == 'none')
                                                    <option value="on book">On Books</option>
                                                    <option value="semi">Partial On Books</option>
                                                @endif
                                            @endif
                                        </select>
                                        <span class="fa fa-bars form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div class="float-right">
                                    @if($view_modify == 'm')
                                        <a href="{{ route('employees_list', ['id_supermarket' => $employee['supermarket_id']]) }}" class="btn btn-danger by"><i class="fa fa-close"></i> Cancel</a>
                                        <button type="submit" class="btn btn-primary by"><i class="fa fa-edit"></i> Enter</button>
                                    @elseif($view_modify == 'v')
                                        <a href="{{ route('employees_list', ['id_supermarket' => $employee['supermarket_id']]) }}" class="btn btn-secondary by"><i class="fa fa-arrow-left"></i> Back</a>
                                    @endif
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
                            <br/>
                            <br/>
                            <hr/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/employee.js') }}"></script>
    <script>
        $( function() {
            $('form').submit(function (){
                disabledButtonSubmit();
            });
        });
        decisionCargarPagina();
        validarSalaryTypeOnChange();
    </script>
@endpush
