@extends('layout.payroll_app')

@section('style')
    <style>
       body{overflow: auto !important;}
       .x_title{padding: 10px 17px;}
       .card-body{padding: 0;}
       .x_panel{margin-bottom: 10px;}
    </style>
@endsection

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-md-offset-2" style="padding-bottom: 4em;">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div>
                            <div class="centar_horizontal">
                                <h2 class="th2">{{ $supermarket['name'] }} supermarket</h2>
                                <h5 class="th5">{{ $supermarket['address'] }}</h5>
                                <h5 class="th5"><i class="fa fa-list-alt"></i> PAYROLL REPORT</h5>
                            </div>

                            <br/>
                            <br/>
                            <div class="float-right" style="text-align:end">
                                <h6 class="th6"><i class="fa fa-calendar-o"></i> Week start: {{ $date_begin }}</h6>
                                <h6 class="th6"><i class="fa fa-calendar"></i> Week end: {{ $date_end }}</h6>
                            </div>
                            <div class="clear"></div>
                            <br/>
                            <form>
                                @if(!empty($department))
                                    @php($c=0)
                                    @foreach($employeeByDepartment as $dep)
                                        <!--<div class="card">-->
                                          <div class="x_panel">
                                            <div class="x_title">
                                              <h2><i class="fa fa-shopping-cart"></i> {{ $dep['department_name'] }}</h2>
                                                  <input type="hidden" id="generalSetPtoPorcentage" value="{{ $generalSet[0]['porcentage'] }}">
                                              <ul class="nav navbar-right panel_toolbox"><li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li></ul>
                                              <div class="clearfix"></div>
                                            </div>
                                               <div class="x_content">
                                              <div class="card-body row-horizon" style="font-size: 13px !important;">
                                                <table  class="table-cebra">
                                                    <thead>
                                                        <tr>
                                                            <th class="ocultar">Id</th>
                                                            <th class="ocultar">Control</th>
                                                            <th class="pegajosa">Employee Name</th>
                                                            <th>Type of salary</th>
                                                            <th>Total of Work Hours</th>
                                                            <th class="ocultar">Reg Hours</th>
                                                            <th>Hourly Rate</th>
                                                            <th>OT Work Hours</th>
                                                            <th>OT Rate</th>
                                                            <th>PTO Hours</th>
                                                            <th>Gross Wages</th>
                                                            <th>Overtime Wages</th>
                                                            <th>PTO Amount Paid</th>
                                                            <th>Total Wages</th>
                                                            <th>Bonus</th>
                                                            <th>ADP Gross Pay</th>
                                                            <th>ADP Net Pay</th>
                                                            <th>Payroll Taxes</th>
                                                            <th>Direct Deposit</th>
                                                            <th>Net Wages</th>
                                                            <th>Cash</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($dep['employee_info'] as $empde)
                                                        @php($c = $c+1)
                                                        <tr>
                                                            <td class="ocultar">{{ $c }}</td>
                                                            <td class="ocultar" id="idEmployee_{{ $c }}">{{ $empde['id_empl'] }}</td>
                                                            <td class="pegajosa">{{ $empde['name'] }} {{ $empde['last_name'] }}</td>
                                                            <td class="salaryType" id="typeSalary_{{ $c }}">{{ ucwords($empde['salary_type']) }}</td>
                                                            <td><input type="number" id="horaTrabajadas_{{ $c }}" onkeyup="calcularWorkingHours({{ $c }}); grossWage({{ $c }}); overTimeWage({{ $c }}); totalWage({{ $c }}); calcularNetWage({{ $c }});"
                                                                       @if($empde['salary_type'] == 'salary')
                                                                       value="{{$empde['hours_calculated_salary']}}"
                                                                       @else
                                                                        value="0"
                                                                       @endif
                                                                       /></td>
                                                            <td class="ocultar" id="regularHourAmount_{{ $c }}">
                                                                @if($empde['salary_type'] == 'salary')
                                                                    {{$empde['hours_calculated_salary']}}
                                                                @else
                                                                    {{ $generalSet[0]['regular_hours'] }}
                                                                @endif

                                                            </td>
                                                            <td id="regularHourRate_{{ $c }}">{{ $empde['pay_hour'] }}</td>
                                                            <td id="overTimeHour_{{ $c }}">0</td>
                                                            <td id="overTimeRate_{{ $c }}">0</td>
                                                            <td><input type="number" id="ptoHours_{{ $c }}" onkeyup="calcularptoAmountPaid({{ $c }}); totalWage({{ $c }}); calcularNetWage({{ $c }});" value="0"
                                                                @if($empde['pto_status'] == 'inactive')
                                                                    disabled
                                                                @endif
                                                                /></td>
                                                            <td id="grossWage_{{ $c }}">0</td>
                                                            <td id="overTimeWage_{{ $c }}">0</td>
                                                            <td id="ptoAmountPaid_{{ $c }}">0</td>
                                                            <td id="totalWage_{{ $c }}">0</td>
                                                            <td><input type="number" id="bonus_{{ $c }}" value="0" onkeyup="calcularNetWage({{ $c }});"/></td>
                                                            <td><input type="number" id="checkGrossPay_{{ $c }}" value="0" onkeyup="calcularTaxes({{ $c }}); calcularNetWage({{ $c }});"
                                                            @if($empde['on_book'] == 'none')
                                                               disabled
                                                            @endif
                                                                /></td>
                                                            <td><input type="number" id="checkNetPay_{{ $c }}" value="0" onkeyup="calcularTaxes({{ $c }}); calcularNetWage({{ $c }});"
                                                            @if($empde['on_book'] == 'none')
                                                                disabled
                                                            @endif
                                                                /></td>
                                                            <td id="taxes_{{ $c }}">0</td>
                                                            <td><input type="number" id="DDP_{{ $c }}" value="0" onkeyup="calcularNetWage({{ $c }});"/></td>
                                                            <td id="netWage_{{ $c }}">0</td>
                                                            <td id="Cash_{{ $c }}">0</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                          </div>
                                        </div>
                                        <br/>
                                    @endforeach
                                @endif
                            </form>
                        </div>
                        <div class="float-right">
                            <input type="hidden" id="rutaViewPayroll" value="{{ route('view_payroll_info', ['date' => $date_begin]) }}"/>
                            <input type="hidden" id="controlFilasId" value="{{ $c }}"/>
                            <input type="hidden" id="rutaAddPayroll" value="{{ route('add_payroll_info') }}"/>
                            <input type="hidden" id="beginDateVal" value="{{ $date_begin }}"/>
                            <button type="button" class="btn btn-primary by" onclick="savePayroll();"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/payroll.js') }}"></script>
    <script>
        $(function() {
            $(".salaryType").each(function(index){
                if($(this).html() == 'Salary')
                {
                    var id = $(this).attr('id');
                    var c  = $(this).attr('id').split('_');
                    calcularWorkingHours(c[1]);
                    grossWage(c[1]);
                    overTimeWage(c[1]);
                    totalWage(c[1]);
                    calcularNetWage(c[1]);
                    // console.log(c[1]);
                }
            });
        });
    </script>
@endpush
