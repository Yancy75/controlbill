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
    <link href="{{ asset('js/jquery-ui-1.12.1/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap/css/bootstrap-horizon.css') }}" rel="stylesheet">
</head>

<body>
    <div>
        @foreach($payroll_info as $dep)
            @foreach($dep as $empde)
                <div class="print_page"></div>
                <div>

                    <div>
                        <div style="width: 50%">
                            <div class="float-left">
                                <h4>{{ $empde['name'] }}</h4>
                            </div>
                        </div>
                        <h4 class="float-right" style="font-size: 14px;">{{"   ".$date_begin}}</h4>
                        <h4 class="float-right" style="font-size: 14px;">Week Starting:</h4>
                    </div>
                    <div class="clear"></div>
                    <div>
                        <h4 class="float-right" style="font-size: 14px;">{{"   ".$date_end}}</h4>
                        <h4 class="float-right" style="font-size: 14px;">Week Ending:</h4>
                    </div>
                    <div class="clear"></div>
                </div>
                <div>
                    <div class="float-left" style="width: 50% !important; font-size: 12px !important;">
                        <h4>PAYROLL  BREAKDOWN:</h4>
{{--                        Gross Wages--}}
                        <div style="width: 70% !important;">
                            <h5 style="font-size: 12px;">GROSS WAGES:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$&nbsp;{{ number_format($empde['gross_wage'],2) }}</h5>
{{--                            <h5 class="float-left" style="font-size: 12px;">&nbsp;&nbsp;$&nbsp;{{ number_format($empde['gross_wage'],2) }}</h5>--}}
                        </div>

{{--                        Overtime Wage--}}
                        <div style="width: 70% !important;">
                            <h5 style="font-size: 12px;">OVERTIME WAGES: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$&nbsp;{{ number_format($empde['overtime_wage'],2)  }}</h5>
{{--                            <h5 class="float-left" style="font-size: 12px;">&nbsp;&nbsp;$&nbsp;{{ number_format($empde['overtime_wage'],2)  }}</h5>--}}
                        </div>

{{--                        PTO Paid--}}
                        <div style="width: 70% !important;">
                            <h5 style="font-size: 12px;">PTO PAID: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$&nbsp;{{ number_format($empde['pto'],2) }}</h5>
{{--                            <h5 class="float-left" style="font-size: 12px;">&nbsp;&nbsp;$&nbsp;{{ number_format($empde['pto'],2) }}</h5>--}}
                        </div>

{{--                        ADJUST/BONUS:--}}
                        <div style="width: 70% !important;">
                            <h5 style="font-size: 12px;">ADJUST/BONUS:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$&nbsp;{{ number_format($empde['ajust_bonus'],2) }}</h5>
{{--                            <h5 class="float-left" style="font-size: 12px;">&nbsp;&nbsp;$&nbsp;{{ number_format($empde['ajust_bonus'],2) }}</h5>--}}
                        </div>

{{--                        TOTAL WAGES:--}}
                        <div style="width: 70% !important;">
                            <h5 style="font-size: 12px;">TOTAL WAGES:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$&nbsp;{{ number_format($empde['total_wage'],2)  }}</h5>
{{--                            <h5 class="float-left" style="font-size: 12px;">&nbsp;&nbsp;$&nbsp;{{ number_format($empde['total_wage'],2)  }}</h5>--}}
                        </div>

{{--                        TAXES:--}}
                        <div style="width: 70% !important;">
                            <h5 style="font-size: 12px;">TAXES:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$&nbsp;{{ number_format($empde['taxes'],2) }}</h5>
{{--                            <h5 class="float-left" style="font-size: 12px;">&nbsp;&nbsp;$&nbsp;--}}
{{--                                {{ number_format($empde['taxes'],2) }}--}}
{{--                            </h5>--}}
                        </div>

{{--                        NET PAY:--}}
                        <div style="width: 70% !important;">
                            <h5 style="font-size: 12px;">NET PAY:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$&nbsp;{{ number_format($empde['net_pay'],2) }}</h5>
{{--                            <h5 class="float-left" style="font-size: 12px;">&nbsp;&nbsp;$&nbsp;{{ number_format($empde['net_pay'],2) }}--}}
{{--                            </h5>--}}
                        </div>

                        <br/>
                        <h4>PAYMENT  BREAKDOWN:</h4>

{{--                        DIRECT DEPOSIT:--}}
                        <div style="width: 70% !important;">
                            <h5 style="font-size: 12px;">DIRECT DEPOSIT: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$&nbsp;{{ number_format($empde['direct_deposit']) }}</h5>
                            {{--                            <h5 class="float-left" style="font-size: 12px;">&nbsp;&nbsp;$&nbsp;{{ number_format($empde['direct_deposit']) }}</h5>--}}
                        </div>

{{--                        CASH:--}}
                        <div style="width: 70% !important;">
                            <h5 style="font-size: 12px;">CASH:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$&nbsp;{{ number_format($empde['cash'],2) }}</h5>
{{--                            <h5 class="float-left" style="font-size: 12px;">&nbsp;&nbsp;$&nbsp;{{ number_format($empde['cash'],2) }} </h5>--}}
                        </div>


                        @if($empde['on_book'] != 'none')
                            <p> To view your payroll taxes breakdown, login to your ADP payroll account</p>
                        @endif
                    </div>

                    <div class="float-right" style="width: 50% !important; font-size: 12px !important;">
                        @if($empde["salary_type"] == "salary")
                            <p style="font-size: 12px !important; margin-bottom: 0px; text-align: center;">Salary except of OverTime</p>
                        @endif
                        @if(!empty($empde["list_pto"]))
                            <div style="border-style: solid; width: 100%;" class="mr-5">
                                <h6 style="text-align: center;">PTO Hours: {{ $empde["general_pto_hours"] }}|   PTO Hours Used: {{ $empde["pto_usadas"] }} |     PTO Hours Remaining: {{ $empde["pto_restante"] }} </h6>
                                <ul>
                                    @foreach($empde["list_pto"]['list'] as $pto)
                                        <li style="font-size: 10px;">Week starting {{ $pto['inicio'] }} ending {{ $pto['final'] }} you used {{ $pto['pto'] }} PTO Hours</li>
                                    @endforeach
                                </ul>

                            </div>
                        @else
                            <div style="border-style: solid; width: 100%; text-align: center;" class="mr-5">
                                @if($year == '2020')
                                    <p>&nbsp;&nbsp;&nbsp;&nbsp;You will earn 40 hours PTO on the payroll period staring on 01/03/2021</p>
                                @else
                                    <p>&nbsp;&nbsp;&nbsp;&nbsp;You will earn 40 hours PTO after {{ $empde["pto_activation"] }}</p>
                                @endif

                            </div>
                        @endif
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="print_page_break_after"></div>
            @endforeach
        @endforeach
    </div>
</body>
</html>
