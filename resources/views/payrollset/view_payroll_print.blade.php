<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Payroll Module') }}</title>

        <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
        <link href="{{ asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
        <link href="{{ asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">

        <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">

        <link href="{{ asset('css/generals.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="">
            <div class="row">
                <div>
                    <div class="panel panel-default" style="width: 100%;">
                        <div class="panel-heading"></div>
                        <div class="panel-body mr-2">
                            <div style="width: 100%; color: #000000 !important;">
                                <div class="centar_horizontal text-center">
                                    <h2 style="font-size: 35px !important; font-family: Cambria;"><strong>{{ $supermarket->name }} supermarket</strong></h2>
                                    <h3 style="font-size: 15px !important; font-family: Cambria;"><strong>{{ $supermarket->address }}</strong></h3>
                                    <br/>
                                    <h5 style="font-size: 25px !important; font-family: Cambria;"><strong>PAYROLL REPORT</strong></h5>
                                </div>

                                <br/>
                                <br/>
                                <div class="float-right">
                                    <h6 style="font-size: 15px !important; font-family: Cambria;"><strong>Week start: {{ $date_begin }}</strong></h6>
                                    <h6 style="font-size: 15px !important; font-family: Cambria;"><strong>Week end: {{ $date_end }}</strong></h6>
                                </div>
                                <div class="clear"></div>
                                <br/>
                                <br/>
                                <div style="font-size: 11px !important;">
                                    @if(!empty($department))
                                        @foreach($payrollInfo as $key => $dep)
                                            <div class="" style="width: 100%">
                                                <div style = "width: 100% !important; background-color: #C4D79B !important; border-style: solid; border-width: 1px; padding: .25rem 1rem !important;">
                                                    <h6>{{ $key }}</h6>
                                                    <input type="hidden" id="generalSetPtoPorcentage" value="{{ $generalSet[0]['porcentage'] }}">
                                                </div>
                                                <div class="" style="padding: 0%;">
                                                    <table class="table table-striped ml-0 mr-0 borde_table" style="padding: 0% !important; width: 100%;">
                                                        <thead class="" style="font-size: 9px !important; background-color: #3963a0 !important;">
                                                        <tr class="">
                                                            <th class="ocultar" style="font-family: Cambria;font-size: 11px !important; background-color: #ebf1de !important; color: #ffffff; border-style: solid; border-width: 1px; display: none; padding: .50rem;">Id</th>
                                                            <th class="ocultar" style="font-family: Cambria;font-size: 11px !important; background-color: #ebf1de !important; color: #ffffff; border-style: solid; border-width: 1px; padding: .50rem;">Control</th>
                                                            <th class="text-break text-center" style="font-family: Cambria;font-size: 11px !important; background-color: #ebf1de !important; color: #ffffff; border-style: solid; border-width: 1px; padding: .50rem;">Employee Name</th>
                                                            <th class="text-break text-center" style="font-family: Cambria;font-size: 11px !important; background-color: #ebf1de !important; color: #ffffff; border-style: solid; border-width: 1px; padding: .50rem;">Type of Salary</th>
                                                            <th class="text-break text-center" style="font-family: Cambria;font-size: 11px !important; background-color: #ebf1de !important; color: #ffffff; border-style: solid; border-width: 1px; padding: .50rem;">Total of Work Hours</th>
                                                            <th class="text-break text-center ocultar" style="font-family: Cambria;font-size: 11px !important; background-color: #ebf1de !important; color: #ffffff; border-style: solid; border-width: 1px; padding: .50rem;">Reg Hours</th>
                                                            <th class="text-break text-center" style="font-family: Cambria;font-size: 11px !important; background-color: #ebf1de !important; color: #ffffff; border-style: solid; border-width: 1px; padding: .50rem;">Hourly Rate</th>
                                                            <th class="text-break text-center" style="font-family: Cambria;font-size: 11px !important; background-color: #ebf1de !important; color: #ffffff; border-style: solid; border-width: 1px; padding: .50rem;">OT Work Hours</th>
                                                            <th class="text-break text-center" style="font-family: Cambria;font-size: 11px !important; background-color: #ebf1de !important; color: #ffffff; border-style: solid; border-width: 1px; padding: .50rem;">OT Rate</th>
                                                            <th class="text-break text-center" style="font-family: Cambria;font-size: 11px !important; background-color: #ebf1de !important; color: #ffffff; border-style: solid; border-width: 1px; padding: .50rem;">TPO Hours now</th>
                                                            <th class="text-break text-center" style="font-family: Cambria;font-size: 11px !important; background-color: #ebf1de !important; color: #ffffff; border-style: solid; border-width: 1px; padding: .50rem;">Gross Wage</th>
                                                            <th class="text-break text-center" style="font-family: Cambria;font-size: 11px !important; background-color: #ebf1de !important; color: #ffffff; border-style: solid; border-width: 1px; padding: .50rem;">Overtime Wage</th>
                                                            <th class="text-break text-center" style="font-family: Cambria;font-size: 11px !important; background-color: #ebf1de !important; color: #ffffff; border-style: solid; border-width: 1px; padding: .50rem;">PTO Amount Paid</th>
                                                            <th class="text-break text-center" style="font-family: Cambria;font-size: 11px !important; background-color: #ebf1de !important; color: #ffffff; border-style: solid; border-width: 1px; padding: .50rem;">Total Wage</th>
                                                            <th class="text-break text-center" style="font-family: Cambria;font-size: 11px !important; background-color: #ebf1de !important; color: #ffffff; border-style: solid; border-width: 1px; padding: .50rem;">Bonus</th>
                                                            <th class="text-break text-center" style="font-family: Cambria;font-size: 11px !important; background-color: #ebf1de !important; color: #ffffff; border-style: solid; border-width: 1px; padding: .50rem;">ADP Gross Pay</th>
                                                            <th class="text-break text-center" style="font-family: Cambria;font-size: 11px !important; background-color: #ebf1de !important; color: #ffffff; border-style: solid; border-width: 1px; padding: .50rem;">ADP Net Pay</th>
                                                            <th class="text-break text-center" style="font-family: Cambria;font-size: 11px !important; background-color: #ebf1de !important; color: #ffffff; border-style: solid; border-width: 1px; padding: .50rem;">Taxes</th>
                                                            <th class="text-break text-center" style="font-family: Cambria;font-size: 11px !important; background-color: #ebf1de !important; color: #ffffff; border-style: solid; border-width: 1px; padding: .50rem;">DD</th>
                                                            <th class="text-break text-center" style="font-family: Cambria;font-size: 11px !important; background-color: #ebf1de !important; color: #ffffff; border-style: solid; border-width: 1px; padding: .50rem;">Net Wage</th>
                                                            <th class="text-break text-center" style="ebf1defont-family: Cambria;font-size: 11px !important; background-color: #ebf1de !important; color: #ffffff; border-style: solid; border-width: 1px; padding: .50rem;">Cash</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody style="font-size: 9px !important;">
                                                        @foreach($dep as $empde)
                                                            <tr>
                                                                <td class="ocultar" id="idEmployee_{{ $empde['control'] }}" style = "border-style: solid; border-width: 1px; display: none;">{{ $empde['id_empl'] }}</td>
                                                                <td class="ocultar" style = "border-style: solid; border-width: 1px;">{{ $empde['control'] }}</td>
                                                                <td style = "font-family: Cambria;font-size: 11px !important; border-style: solid; border-width: 1px;">{{ $empde['name'] }}</td>
                                                                <td style = "font-family: Cambria;font-size: 11px !important; border-style: solid; border-width: 1px;">{{ ucwords($empde['salary_type']) }}</td>
                                                                <td id="horaTrabajadas_{{ $empde['control'] }}" style = "font-family: Cambria;font-size: 11px !important; border-style: solid; border-width: 1px;">{{ $empde['working_hours'] }}</td>
                                                                <td id="regularHourAmount_{{ $empde['control'] }}" class="ocultar" style = "font-family: Cambria;font-size: 11px !important; border-style: solid; border-width: 1px;">{{ $empde['regular_hours'] }}</td>
                                                                <td id="regularHourRate_{{ $empde['control'] }}" style = "font-family: Cambria;font-size: 11px !important; border-style: solid; border-width: 1px;">{{ '$     '.number_format($empde['pay_hour_pay'],2) }}</td>
                                                                <td id="overTimeHour_{{ $empde['control'] }}" style = "font-family: Cambria;font-size: 11px !important; border-style: solid; border-width: 1px;">{{$empde['over_time_hour']}}</td>
                                                                <td id="overTimeRate_{{ $empde['control'] }}" style = "font-family: Cambria;font-size: 11px !important; border-style: solid; border-width: 1px;">{{ '$     '.number_format($empde['over_time_rate'],2) }}</td>
                                                                <td id="ptoHours_{{ $empde['control'] }}" style = "font-family: Cambria;font-size: 11px !important; border-style: solid; border-width: 1px;">{{ $empde['pto'] }}</td>
                                                                <td id="grossWage_{{ $empde['control'] }}" style = "font-family: Cambria;font-size: 11px !important; border-style: solid; border-width: 1px;">{{ '$     '.number_format($empde['gross_wage'],2) }}</td>
                                                                <td id="overTimeWage_{{ $empde['control'] }}" style = "font-family: Cambria;font-size: 11px !important; border-style: solid; border-width: 1px;">{{ '$     '.number_format($empde['over_time_wage'],2) }}</td>
                                                                <td id="ptoAmountPaid_{{ $empde['control'] }}" style = "font-family: Cambria;font-size: 11px !important; border-style: solid; border-width: 1px;">{{ '$     '.number_format($empde['pto_amount_paid'],2)}}</td>
                                                                <td id="totalWage_{{ $empde['control'] }}" style = "font-family: Cambria;font-size: 11px !important; border-style: solid; border-width: 1px;">{{ '$     '.number_format($empde['total_wage'],2) }}</td>
                                                                <td id="bonus_{{ $empde['control'] }}" style = "font-family: Cambria;font-size: 11px !important; border-style: solid; border-width: 1px;">{{ '$     '.number_format($empde['ajust_bonus'],2) }}</td>
                                                                <td id="checkGrossPay_{{ $empde['control'] }}" style = "font-family: Cambria;font-size: 11px !important; border-style: solid; border-width: 1px;">{{ '$     '.number_format($empde['check_gross'],2) }}</td>
                                                                <td id="checkNetPay_{{ $empde['control'] }}" style = "font-family: Cambria;font-size: 11px !important; border-style: solid; border-width: 1px;">{{ '$     '.number_format($empde['check_net'],2) }}</td>
                                                                <td id="taxes_{{ $empde['control'] }}" style = "font-family: Cambria;font-size: 11px !important; border-style: solid; border-width: 1px;">{{ '$     '.number_format($empde['taxes'],2) }}</td>
                                                                <td id="DDP_{{ $empde['control'] }}" style = "font-family: Cambria;font-size: 11px !important; border-style: solid; border-width: 1px;">{{ '$     '.number_format($empde['direct_deposit'],2) }}</td>
                                                                <td id="netWage_{{ $empde['control'] }}" style = "font-family: Cambria;font-size: 11px !important; border-style: solid; border-width: 1px; background-color: #E4DFEC !important;">{{ '$     '.number_format($empde['net_wage'],2) }}</td>
                                                                <td id="Cash_{{ $empde['control'] }}" style = "font-family: Cambria;font-size: 11px !important; border-style: solid; border-width: 1px; background-color: #E4DFEC !important;">{{ '$     '.number_format($empde['cash'],2) }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <br/>
                                        @endforeach
                                    @endif
                                </div>


                                <div class="centrado" style="padding-top: 4em; padding-bottom: 4em; flex-direction: column; justify-content: center; text-align: center;">
                                    <h2>DEPARTMENT NET TOTALS:</h2>

                                    <div id="departmentNetTotal" class="col-6 align-self-center">
                                        <table border="1" style="width: 100%; box-shadow: 2px 2px 6px black;">
                                            @foreach($totales['total_por_departamento'] as $key => $paySet)
                                                <tr>
                                                    <td class="tda"><h4>{{ $key }} <span style="font-size: 14px!important;">({{ $totales['porcentaje_total_por_departamento'][$key] }}%)</span></h4></td>
                                                    <td class="tdb" ><div class="diva">
                                                            {{ '$     '.number_format($paySet,2) }}
                                                        </div></td>
                                                </tr>

                                            @endforeach


                                            <tr>
                                                <td class="bg-warning"><h4 class="ip">Gross Total:</h4></td>
                                                <td class="tdb" style="background-color:#f5ce99;"> <div class="diva ip" id="total_gross_id">
                                                        <span><strong>{{ '$     '.number_format($totales['total_gross_wage'],2, '.',',') }}</strong></span>
                                                    </div></td>
                                            </tr>
                                            <tr>
                                                <td class="tda"><h4>Taxes Total:</h4></td>
                                                <td class="tdb"><div class="diva">
                                                        <span><strong>{{ '$     '.number_format($totales['total_taxes'],2, '.',',') }}</strong></span>
                                                    </div></td>
                                            </tr>
                                            <tr>
                                                <td class="bg-success"><h4 class="ip">Net Total:</h4></td>
                                                <td class="tdb" style="background-color:orange;"> <div class="diva ip">
                                                        <span><strong>{{ '$     '.number_format($totales['total_net_wage'],2, '.',',') }}</strong></span>
                                                    </div></td>
                                            </tr>
                                            <tr>
                                                <td class="tda"><h4>Direct Deposit Total</h4></td>
                                                <td class="tdb"><div class="diva">
                                                        <span><strong>{{ '$     '.number_format($totales['total_direct_deposit'],2, '.',',') }}</strong></span>
                                                    </div></td>
                                            </tr>
                                            <tr>
                                                <td class="bg-success"><h4 class="ip">Cash Needed for this Period</h4></td>
                                                <td  class="tdb"  style="background-color:orange;" ><div class="diva ip">
                                                        <span><strong>{{ '$     '.number_format($totales['total_cash'],2, '.',',') }}</strong></span>
                                                    </div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
