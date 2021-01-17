@extends('layout.payroll_app')

@section('style')
    <style>
       body{overflow: auto !important;}
       .x_title{padding: 10px 17px;}
       .card-body{padding: 0;}
       .x_panel{margin-bottom: 10px;}
       h4{text-align: start; padding: 5px; margin-bottom: 1px;}
       .tda{background: white; color: black;}
       .tdb{box-shadow: 0px 0px 3px black inset; background: white;}
       .diva{padding-left: 10px; padding-right: 10px; font-size: 1.5em;}
      .ip{    color: white;   font-weight: 900;  text-shadow: 1px 1px 2px black;}
    </style>
@endsection

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <div>
                            <div class="centar_horizontal">
                                <h2 class="th2">{{ $supermarket['name'] }} supermarket</h2>
                                <h5 class="th5">{{ $supermarket['address'] }}</h5>
                                <h5 class="th5"><i class="fa fa-list-alt"></i> PAYROLL REPORT</h5>
                                <a class="btn btn-primary by" href="{{ route('view_payroll_info_without_menu', ['date' => $date_begin] ) }}" target="_blank"><i class="fa fa-print"></i> Print/View Report</a>
                                <a class="btn btn-success by" href="{{ route('view_payroll_info_without_menu_double', ['date' => $date_begin] ) }}" target="_blank"><i class="fa fa-print"></i> Employee Pay Stub Print/View Report</a>
                                <a class="btn btn-warning by" href="{{ route('add_individual_employee', ['date' => $date_begin] ) }}"><i class="fa fa-plus"></i> Add Employee</a>
                            </div>
                            <br/>
                            @if (session('menssage'))
                                <div class="alert alert-danger">
                                    {{ session('menssage') }}
                                </div>
                            @endif
                            <br/>
                            <div class="float-right" style="text-align:end">
                                <h6 class="th6"><i class="fa fa-calendar-o"></i> Week start: {{ $date_begin }}</h6>
                                <h6 class="th6"><i class="fa fa-calendar-o"></i> Week end: {{ $date_end }}</h6>
                            </div>
                            <div class="clear"></div>
                            <br/>
                            <form>
                                @if(!empty($department))
                                    @php($c=0)
                                    @foreach($payrollSetByEmployee as $dep)
                                        @if($dep['employee_info']->isNotEmpty())
                                            <div class="x_panel" style="font-size: 12px !important;">
                                                <div class="x_title">
                                                  <h2><i class="fa fa-shopping-cart"></i> {{ $dep['department_name'] }}</h2>
                                                      <input type="hidden" id="generalSetPtoPorcentage" value="{{ $generalSet[0]['porcentage'] }}">
                                                  <ul class="nav navbar-right panel_toolbox"><li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li></ul>
                                                  <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">
                                                 <div class="card-body row-horizon">
                                                    <table class="table table-striped" style="position: relative; padding: 1% !important;">
                                                        <thead class="thead-dark">
                                                        <tr>
                                                            <th class="ocultar">Id</th>
                                                            <th class="ocultar">Control</th>
                                                            <th>Employee Name</th>
                                                            <th>Type of Salary</th>
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
                                                                <td class=""><a href="{{ route('modify_employee_payroll_info', ['id' => $empde['id_pay']]) }}">{{ $empde['name'] }} {{ $empde['last_name'] }}</a></td>
                                                                <td>{{ ucwords($empde['type_salary']) }}</td>
                                                                <td id="horaTrabajadas_{{ $c }}">{{ number_format($empde['working_hours'],2,'.',',') }}</td>
                                                                <td id="regularHourAmount_{{ $c }}" class="ocultar">
{{--                                                                    @if($empde['type_salary'] == 'salary')--}}
                                                                        {{ number_format($empde['regular_hours_amount'],2,'.',',') }}
{{--                                                                    @else--}}
{{--                                                                        {{ number_format($generalSet[0]['regular_hours'],2,'.',',') }}--}}
{{--                                                                    @endif--}}
                                                                </td>
                                                                <td id="regularHourRate_{{ $c }}">{{ number_format($empde['pay_hour_pay'],2,'.',',') }}</td>
                                                                <td id="overTimeHour_{{ $c }}">
{{--                                                                    @if($empde['type_salary'] == 'salary')--}}
                                                                        @if($empde['working_hours'] > $empde['regular_hours_amount'])
                                                                            {{ number_format($empde['working_hours'],2) - number_format($empde['regular_hours_amount'],2) }}
                                                                        @else
                                                                            0
                                                                        @endif
{{--                                                                    @else--}}
{{--                                                                        @if($empde['working_hours'] > $generalSet[0]['regular_hours'])--}}
{{--                                                                            {{ number_format($empde['working_hours'],2) - number_format($generalSet[0]['regular_hours'],2) }}--}}
{{--                                                                        @else--}}
{{--                                                                            0--}}
{{--                                                                        @endif--}}
{{--                                                                    @endif--}}
                                                                </td>
                                                                <td id="overTimeRate_{{ $c }}">
{{--                                                                    @if($empde['type_salary'] == 'salary')--}}
                                                                        @if(($empde['working_hours'] > $empde['regular_hours_amount']))
                                                                            {{ number_format($empde['pay_hour'] * (1 + (number_format($generalSet[0]['porcentage']/100,2))),2,'.',',')  }}
                                                                        @else
                                                                            0
                                                                        @endif
{{--                                                                    @else--}}
{{--                                                                        @if(($empde['working_hours'] > $generalSet[0]['regular_hours']))--}}
{{--                                                                            {{ number_format($empde['pay_hour'] * (1 + (number_format($generalSet[0]['porcentage']/100,2))),2,'.',',')  }}--}}
{{--                                                                        @else--}}
{{--                                                                            0--}}
{{--                                                                        @endif--}}
{{--                                                                    @endif--}}

                                                                </td>
                                                                <td id="ptoHours_{{ $c }}">{{ $empde['pto'] }}</td>
                                                                <td id="grossWage_{{ $c }}">
{{--                                                                    @if($empde['type_salary'] == 'salary')--}}
                                                                        @if($empde['working_hours'] > $empde['regular_hours_amount'])
                                                                            @php($grossWage = number_format($empde['regular_hours_amount'],2) * number_format($empde['pay_hour_pay'],2))
                                                                            {{ number_format($grossWage,2 ,'.',',')  }}
                                                                        @else
                                                                            @php($grossWage = number_format($empde['working_hours'],2) * number_format($empde['pay_hour_pay'],2))
                                                                            {{ number_format($grossWage,2, '.',',') }}
                                                                        @endif
{{--                                                                    @else--}}
{{--                                                                        @if($empde['working_hours'] > $generalSet[0]['regular_hours'])--}}
{{--                                                                            @php($grossWage = $generalSet[0]['regular_hours'] * $empde['pay_hour_pay'])--}}
{{--                                                                            {{ number_format($grossWage,2 ,'.',',')  }}--}}
{{--                                                                        @else--}}
{{--                                                                            @php($grossWage = $empde['working_hours'] * $empde['pay_hour_pay'])--}}
{{--                                                                            {{ number_format($grossWage,2, '.',',') }}--}}
{{--                                                                        @endif--}}
{{--                                                                    @endif--}}
                                                                </td>
                                                                <td id="overTimeWage_{{ $c }}">
                                                                    @php($overTimeWage = 0)

{{--                                                                    @if($empde['type_salary'] == 'salary')--}}
                                                                        @if($empde['working_hours'] > $empde['regular_hours_amount'])
                                                                            @php($overTime = number_format($empde['working_hours'],2) - number_format($empde['regular_hours_amount'],2))
                                                                            @php($overTimehour = number_format($empde['pay_hour_pay'],2) * (1 + (number_format($generalSet[0]['porcentage']/100,2))))
                                                                            @php($overTimeWage = number_format($overTime,2) * number_format($overTimehour,2))
                                                                            {{ number_format($overTimeWage,2, '.',',') }}
                                                                        @else
                                                                            0
                                                                        @endif
{{--                                                                    @else--}}
{{--                                                                        @if($empde['working_hours'] > $generalSet[0]['regular_hours'])--}}
{{--                                                                            @php($overTime = number_format($empde['working_hours'],2) - number_format($generalSet[0]['regular_hours'],2))--}}
{{--                                                                            @php($overTimehour = number_format($empde['pay_hour_pay'],2) * (1 + (number_format($generalSet[0]['porcentage']/100,2))))--}}
{{--                                                                            @php($overTimeWage = number_format($overTime,2) * number_format($overTimehour,2))--}}
{{--                                                                            {{ number_format($overTimeWage,2, '.',',') }}--}}
{{--                                                                        @else--}}
{{--                                                                            0--}}
{{--                                                                        @endif--}}
{{--                                                                    @endif--}}


                                                                </td>
                                                                <td id="ptoAmountPaid_{{ $c }}">{{ number_format(number_format($empde['pto'],2) * number_format($empde['pay_hour_pay'],2),2 ,'.',',') }}</td>
                                                                <td id="totalWage_{{ $c }}">{{ number_format((number_format($empde['pto'],2) * number_format($empde['pay_hour_pay'],2)) + $overTimeWage + $grossWage,2 ,'.',',') }}</td>
                                                                <td id="bonus_{{ $c }}">{{ number_format($empde['ajust_bonus'],2 ,'.',',') }}</td>
                                                                <td id="checkGrossPay_{{ $c }}">{{ number_format($empde['check_gross'],2 ,'.',',') }}</td>
                                                                <td id="checkNetPay_{{ $c }}">{{ number_format($empde['check_net'],2 ,'.',',') }}</td>
                                                                <td id="taxes_{{ $c }}">{{ number_format($empde['taxes'],2 ,'.',',') }}</td>
                                                                <td id="DDP_{{ $c }}">{{ number_format($empde['direct_deposit'],2 ,'.',',') }}</td>
                                                                <td id="netWage_{{ $c }}">{{ number_format(((number_format($empde['pto'],2) * number_format($empde['pay_hour_pay'],2)) + $overTimeWage + $grossWage) + number_format($empde['ajust_bonus'],2) - number_format($empde['taxes'],2),2 ,'.',',') }}</td>
                                                                <td id="Cash_{{ $c }}">{{ number_format((((number_format($empde['pto'],2) * number_format($empde['pay_hour_pay'],2)) + $overTimeWage + $grossWage) + number_format($empde['ajust_bonus'],2) - number_format($empde['taxes'],2)) - number_format($empde['direct_deposit'],2),2 ,'.',',') }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                              </div>
                                            </div>
                                            <br/>
                                        @endif
                                    @endforeach
                                @endif
                            </form>
                          <div class="centrado" style="padding-top: 4em; padding-bottom: 4em; display: flex; flex-direction: column; justify-content: center; text-align: center;">
                              <h2 class="th5">DEPARTMENT NET TOTALS:</h2>
                            <div id="departmentNetTotal" class="col-6 align-self-center">
                              <table border="1" style="width: 100%; box-shadow: 2px 2px 6px black;">
                                @php($total_net_wage = 0)
                                @php($total_gross_wage = 0)
                                @php($total_taxes = 0)
                                @php($d_d = 0)
                                @php($c = 0)

                              @foreach($payrollSetByEmployee as $paySet)
                                    @if($paySet['employee_info']->isNotEmpty())
                                        @php($taxes_by_dep = 0)
                                        @php($net_wage = 0)
                                        @php($gross_wage = 0)
                                        @foreach($paySet['employee_info'] as $pay)
                                            @php($grossWage = 0)
                                            @php($overTimeWage = 0)
                                            @php($overTime = 0)
                                            @php($overTimehour = 0)
{{--                                            @if($pay['type_salary'] == 'salary')--}}
                                                @if($pay['working_hours'] > $pay['regular_hours_amount'])
                                                    @php($grossWage = number_format($pay['regular_hours_amount'],2) * number_format($pay['pay_hour_pay'],2))

                                                    @php($overTime = number_format($pay['working_hours'],2) - number_format($pay['regular_hours_amount'],2))
                                                    @php($overTimehour = number_format($pay['pay_hour'],2) * (1 + (number_format($generalSet[0]['porcentage']/100,2))))
                                                    @php($overTimeWage = $overTime * $overTimehour)
                                                @else
                                                    @php($grossWage = number_format($pay['working_hours'],2) * number_format($pay['pay_hour_pay'],2))
                                                @endif
{{--                                            @else--}}
{{--                                                @if($pay['working_hours'] > $generalSet[0]['regular_hours'])--}}
{{--                                                    @php($grossWage = number_format($generalSet[0]['regular_hours'],2) * number_format($pay['pay_hour_pay'],2))--}}

{{--                                                    @php($overTime = number_format($pay['working_hours'],2) - number_format($generalSet[0]['regular_hours'],2))--}}
{{--                                                    @php($overTimehour = number_format($pay['pay_hour'],2) * (1 + (number_format($generalSet[0]['porcentage']/100,2))))--}}
{{--                                                    @php($overTimeWage = $overTime * $overTimehour)--}}
{{--                                                @else--}}
{{--                                                    @php($grossWage = number_format($pay['working_hours'],2) * number_format($pay['pay_hour_pay'],2))--}}
{{--                                                @endif--}}
{{--                                            @endif--}}
                                            @php($taxes_by_dep = $taxes_by_dep + number_format($pay['taxes'],2))
                                            @php($net_wage = $net_wage + ((number_format($pay['pto'],2) * number_format($pay['pay_hour_pay'],2)) + $overTimeWage + $grossWage + number_format($pay['ajust_bonus'],2) - number_format($pay['taxes'],2)))
                                            @php($gross_wage = $gross_wage + (((number_format($pay['pto'],2) * number_format($pay['pay_hour_pay'],2)) + $overTimeWage + $grossWage) + number_format($pay['ajust_bonus'],2)))
                                        @endforeach

                                        @php($d_d = $d_d + number_format($empde['direct_deposit'],2))
                                        @php($total_taxes = $total_taxes + $taxes_by_dep)
                                        @php($total_net_wage = $total_net_wage + $net_wage)
                                        @php($total_gross_wage = $total_gross_wage + $gross_wage)

                                          <tr>
                                          <td class="tda"><h4>{{ $paySet['department_name'] }}<span id="mostrarpor_{{ $c }}" class="float-right" style="font-size: 14px!important;"></span></h4></td>
                                            <td class="tdb" ><div class="diva" id="calpor_{{ $c }}">
                                                {{ '$     '.number_format($gross_wage, 2,'.', ',') }}
                                            </div></td>

                                      </tr>
                                          @php($c = $c+1)
                                    @endif
                              @endforeach

                                  <tr>
                                      <td class="bg-warning"><h4 class="ip">Gross Total:</h4></td>
                                      <td class="tdb" style="background-color:#f5ce99;"> <div class="diva ip" id="total_gross_id">
                                              {{ '$     '.number_format($total_gross_wage, 2,'.', ',') }}
                                          </div></td>
                                  </tr>
                                  <tr>
                                      <td class="tda"><h4>Total Taxes</h4></td>
                                      <td class="tdb"><div class="diva">
                                              {{ '$     '.number_format($total_taxes, 2,'.', ',') }}
                                          </div></td>
                                  </tr>
                                  <tr>
                                <tr>
                                    <td class="bg-success"><h4 class="ip">Net Total:</h4></td>
                                    <td class="tdb" style="background-color:orange;"> <div class="diva ip">
                                        {{ '$     '.number_format($total_net_wage, 2,'.', ',') }}
                                    </div></td>
                                </tr>
                                <tr>
                                  <td class="tda"><h4>Direct Deposit Total</h4></td>
                                   <td class="tdb"><div class="diva">
                                        {{ '$     '.number_format($d_d, 2,'.', ',') }}
                                    </div></td>
                                  </tr>
                                <tr>
                                    <td class="bg-success"><h4 class="ip">Cash Needed for this Period</h4></td>
                                    <td  class="tdb"  style="background-color:orange;" ><div class="diva ip">
                                        {{ '$     '.number_format(($total_net_wage - $d_d), 2,'.', ',') }}
                                    </div></td>
                                </tr>
                              </table>
                                <input type="hidden" id="control_departamento_total" value="{{ $c }}">
                            </div>
                          </div>
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
        $(function ()
        {
            var control = $("#control_departamento_total").val();
            var total   = parseFloat($("#total_gross_id").html().replace(/[\$\s*]*[,]*/g, ''));

            for(var i = 0; i < control; i++)
            {
                var numerador = parseFloat($("#calpor_"+ i).html().replace(/[\$\s*]*[,]*/g, ''));

                var porcentaje = (numerador/total)*100;

                $('#mostrarpor_'+ i).html("("+porcentaje.toFixed(2)+"%)");
            }
            return;
        });
    </script>
@endpush
