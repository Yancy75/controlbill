@extends('layout.payroll_app')

@section('style')
    <link href="{{ asset('js/jquery-ui-1.12.1/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap/css/bootstrap-horizon.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row" style="justify-content: center;">
              <div class="col-md-8 col-sm-8 ">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                            <div class="centar_horizontal">
                                <h2 class="th2">{{ $supermarket['name'] }} supermarket</h2>
                                <h5 class="th5">{{ $supermarket['address'] }}</h5>
                                <hr/>
                                <h5 class="th5">MODIFY PAYROLL INFORMATION OF {{ $info[0]['name'] }} {{ $info[0]['last_name'] }}</h5>
                            </div>
                            <div class="float-right" style="text-align:end">
                                <h6 class="th6"><i class="fa fa-calendar-o"></i> Week start: {{ $date_begin }}</h6>
                                <h6 class="th6"><i class="fa fa-calendar-o"></i> Week end: {{ $date_end }}</h6>
                            </div>
                            <div class="clear"></div>
                            <div class="x_panel">

                              <div class="x_title">
                                <h2><i class="fa fa-shopping-cart"></i> MODIFY PAYROLL INFORMATION </h2>
                                 <ul class="nav navbar-right panel_toolbox">
                                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                  <li><a class="btn btn-dark by" href="{{ route('view_payroll_info', ['date' => $date_begin ]) }}"><i class="fa fa-undo"></i> Back</a></li>
                                 </ul>
                                <div class="clearfix"></div>
                              </div>
                                 <div class="x_content">
                                <form method="post" action="{{ route('update_employee_payroll_info') }}" class="form-horizontal form-label-left">
                                    @csrf
                                    <input type="hidden" class="form-control" id="inputPayset" name="inputPayset" value="{{ $info[0]['id_payset'] }}" >
                                    <input type="hidden" class="form-control" id="inputPorcentage" name="inputPorcentage" value="{{ number_format($generalSet[0]['porcentage'],2) }}" >

                                    <div class="form-group row">
                                        <label for="inputTotalOfHours" class="control-label col-md-2 col-sm-2">Total of hours:</label>
                                          <div class="col-md-10 col-sm-10 ">
                                            <input type="number" step="any" class="form-control" id="inputTotalOfHours" name="inputTotalOfHours" value="{{ number_format($info[0]['working_hours'],2) }}" onkeyup="modifyCalcularWorkingHours(); modifyGrossWage(); modifyOverTimeWage(); modifyTotalWage(); modifyCalcularNetWage();">
                                             <span class="fa fa-clock-o form-control-feedback right" aria-hidden="true"></span>
                                           </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputRegHours" class="control-label col-md-2 col-sm-2">Reg Hours:</label>
                                        <div class="col-md-10 col-sm-10 ">
                                        <input type="number" step="any" class="form-control" id="inputRegHours" name="inputRegHours" value="{{ number_format($info[0]['regular_hours_amount'],2) }}" disabled>
                                               <span class="fa fa-clock-o form-control-feedback right" aria-hidden="true"></span>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputRegRate" class="control-label col-md-2 col-sm-2">Reg Rate:</label>
                                          <div class="col-md-10 col-sm-10 ">
                                            <input type="number" step="any" class="form-control" id="inputRegRate" name="inputRegRate" value="{{ number_format($info[0]['pay_hour_pay'],2) }}" >
                                               <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                        @if($info[0]['working_hours'] > $info[0]['regular_hours_amount'])
                                            @php($ot_hour = number_format($info[0]['working_hours'],2) - number_format($info[0]['regular_hours_amount'],2))
                                        @else
                                            @php($ot_hour = 0)
                                        @endif
                                        <label for="inputOTHour" class="control-label col-md-2 col-sm-2">OT Hour:</label>
                                          <div class="col-md-10 col-sm-10 ">
                                           <input type="number" step="any" class="form-control" id="inputOTHour" name="inputOTHour" value="{{ number_format($ot_hour, 2, '.', '') }}" disabled>
                                           <span class="fa fa-clock-o form-control-feedback right" aria-hidden="true"></span>
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                        @if($info[0]['working_hours'] > $info[0]['regular_hours_amount'])
                                            @php($ot_rate = number_format($info[0]['pay_hour_pay'],2) * (1 + (number_format($generalSet[0]['porcentage']/100,2))) )
                                        @else
                                            @php($ot_rate = 0)
                                        @endif
                                        <label for="inputOTRate" class="control-label col-md-2 col-sm-2">OT Rate:</label>
                                          <div class="col-md-10 col-sm-10 ">
                                        <input type="number" step="any" class="form-control" id="inputOTRate" name="inputOTRate" value="{{ number_format($ot_rate, 2, '.', '') }}" disabled>
                                           <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputTPOHour" class="control-label col-md-2 col-sm-2">TPO Hours:</label>
                                                 <div class="col-md-10 col-sm-10 ">
                                        <input type="number" step="any" class="form-control" id="inputTPOHour" name="inputTPOHour" value="{{ number_format($info[0]['pto'],2) }}" onkeyup="ModifyCalcularptoAmountPaid(); modifyTotalWage(); modifyCalcularNetWage();">
                                        <span class="fa fa-clock-o form-control-feedback right" aria-hidden="true"></span>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                        @if($info[0]['working_hours'] > $info[0]['regular_hours_amount'])
                                            @php($grossWage = number_format($info[0]['regular_hours_amount'],2) * number_format($info[0]['pay_hour_pay'],2))
                                        @else
                                            @php($grossWage = number_format($info[0]['working_hours'],2) * number_format($info[0]['pay_hour_pay'],2))
                                        @endif
                                        <label for="inputGrossWage" class="control-label col-md-2 col-sm-2">Gross Wage:</label>
                                          <div class="col-md-10 col-sm-10 ">
                                        <input type="number" step="any" class="form-control" id="inputGrossWage" name="inputGrossWage" value="{{ number_format($grossWage, 2, '.', '')  }}" disabled>
                                        <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                                   </div>
                                    </div>
                                    <div class="form-group row">
                                        @php($overTimeWage = 0)
                                        @if($info[0]['working_hours'] > $info[0]['regular_hours_amount'])
                                            @php($overTime = number_format($info[0]['working_hours'],2) - number_format($info[0]['regular_hours_amount'],2))
                                            @php($overTimehour = number_format($info[0]['pay_hour_pay'],2) * (1 + (number_format($generalSet[0]['porcentage']/100,2))))
                                            @php($overTimeWage = $overTime * $overTimehour)
                                        @else
                                            @php($overTimeWage = 0)
                                        @endif
                                        <label for="inputOvertimeWage" class="control-label col-md-2 col-sm-2">Overtime Wage:</label>
                                          <div class="col-md-10 col-sm-10 ">
                                        <input type="number" step="any" class="form-control" id="inputOvertimeWage" name="inputOvertimeWage" value="{{ number_format($overTimeWage, 2, '.', '') }}" disabled>
                                        <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                                   </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPTOAmountPaid" class="control-label col-md-2 col-sm-2">PTO Amount Paid:</label>
                                          <div class="col-md-10 col-sm-10 ">
                                        <input type="number" step="any" class="form-control" id="inputPTOAmountPaid" name="inputPTOAmountPaid" value="{{ number_format(($info[0]['pto'] * $info[0]['pay_hour_pay']), 2, '.', '') }}" disabled>
                                        <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                                   </div>
                                      </div>
                                    <div class="form-group row">
                                        <label for="inputTotalWage" class="control-label col-md-2 col-sm-2">Total Wage:</label>
                                          <div class="col-md-10 col-sm-10 ">
                                        <input type="number" step="any" class="form-control" id="inputTotalWage" name="inputTotalWage" value="{{ number_format((($info[0]['pto'] * $info[0]['pay_hour_pay']) + $overTimeWage + $grossWage), 2, '.', '') }}" disabled>
                                        <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                                   </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputBonus" class="control-label col-md-2 col-sm-2">Bonus:</label>
                                          <div class="col-md-10 col-sm-10 ">
                                        <input type="number" step="any" class="form-control" id="inputBonus" name="inputBonus" value="{{ number_format($info[0]['ajust_bonus'], 2, '.', '') }}" onkeyup="modifyCalcularNetWage();">
                                        <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                                   </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputCheckGrossPay" class="control-label col-md-2 col-sm-2">Check Gross Pay:</label>
                                          <div class="col-md-10 col-sm-10 ">
                                        <input type="number" step="any" class="form-control" id="inputCheckGrossPay" name="inputCheckGrossPay" value="{{ number_format($info[0]['check_gross'], 2, '.', '') }}" onkeyup="modifyCalcularNetWage(); modifyCalcularTaxes();">
                                        <span class="fa fa-credit-card form-control-feedback right" aria-hidden="true"></span>
                                   </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputCheckNetPay" class="control-label col-md-2 col-sm-2">Check Net Pay:</label>
                                          <div class="col-md-10 col-sm-10 ">
                                        <input type="number" step="any" class="form-control" id="inputCheckNetPay" name="inputCheckNetPay" value="{{ number_format($info[0]['check_net'], 2, '.', '') }}" onkeyup="modifyCalcularNetWage(); modifyCalcularTaxes();">
                                        <span class="fa fa-credit-card form-control-feedback right" aria-hidden="true"></span>
                                   </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputTaxes" class="control-label col-md-2 col-sm-2">Taxes:</label>
                                          <div class="col-md-10 col-sm-10 ">
                                        <input type="number" step="any" class="form-control" id="inputTaxes" name="inputTaxes" value="{{ number_format($info[0]['taxes'], 2, '.', '') }}" readonly>
                                        <span class="fa fa-tasks form-control-feedback right" aria-hidden="true"></span>
                                   </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputDirectDeposit" class="control-label col-md-2 col-sm-2">Direct Deposit:</label>
                                          <div class="col-md-10 col-sm-10 ">
                                        <input type="number" step="any" class="form-control" id="inputDirectDeposit" name="inputDirectDeposit" value="{{ number_format($info[0]['direct_deposit'], 2, '.', '') }}" onkeyup="modifyCalcularNetWage();">
                                        <span class="fa fa-tasks form-control-feedback right" aria-hidden="true"></span>
                                   </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputNetWage" class="control-label col-md-2 col-sm-2">Net Wage:</label>
                                          <div class="col-md-10 col-sm-10 ">
                                        <input type="number" step="any" class="form-control" id="inputNetWage" name="inputNetWage" value="{{ number_format(((($info[0]['pto'] * $info[0]['pay_hour_pay']) + $overTimeWage + $grossWage) + $info[0]['ajust_bonus'] - $info[0]['taxes']), 2, '.', '') }}" disabled>
                                        <span class="fa fa-tasks form-control-feedback right" aria-hidden="true"></span>
                                   </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputCash" class="control-label col-md-2 col-sm-2">Cash:</label>
                                          <div class="col-md-10 col-sm-10 ">
                                        <input type="number" step="any" class="form-control" id="inputCash" name="inputCash" value="{{ number_format((((($info[0]['pto'] * $info[0]['pay_hour_pay']) + $overTimeWage + $grossWage) + $info[0]['ajust_bonus'] - $info[0]['taxes']) - $info[0]['direct_deposit']), 2, '.', '') }}" disabled>
                                        <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                                   </div>
                                    </div>
                                    <hr>
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-primary by"><i class="fa fa-edit"></i> Modify</button>
                                    </div>
                                    <div class="clear"></div>
                                    <br/>
                                </form>
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
@endpush
