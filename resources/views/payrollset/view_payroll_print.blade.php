<?php ob_start(); ?>
<html>
    <head>
        <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    </head>
    <style>
     @page {  margin-top: 150px;  margin-bottom: 80px;  margin-right: 50px;  margin-left: 50px; }
     #header { position: fixed; top: -150px; right: 0px; height: 100px; border-bottom: 2px solid black; text-align: right; font-weight: bold; text-transform: uppercase; padding-top: 5px;}
     #footer { position: fixed; left: 0px; bottom: -80px; right: 0px; height: 60px; text-align: right; padding-right: 20px; border-top: 2px solid black;}
     #footer .page:after { content: counter(page); }
     .titulo2{font-size: 35px !important; font-family:sans-serif; color:#ff711e;}
     .h{text-align: center;}
     .f{background-color: #E4DFEC !important;}
     .table { clear: both; margin-bottom: 6px !important; max-width: none !important; border-spacing: 0;}
     .table-bordered {font-size: 15px !important;}
      .odd1{background-color: rgba(0,0,0,.05);}
     .card-body {margin-left: 20%; margin-right: 20%;}
      .table {border: 1px solid black;  border-collapse: collapse;}
      td, th {border: 1px solid #dee2e6;  border-collapse: collapse;}
     .td1{font-size: 11px !important; font-family: sans-serif;}
      th{padding: .50rem; padding: .2rem;}
      .tbro{font-size: 11px !important; font-family: sans-serif; background-color: #ebf1de !important;}
      .tbro1{font-size: 14px !important;  background-color: #C4D79B !important; font-weight: bold;  line-height: 1.5em; padding: 0.75rem;}
      .tda{font-family: sans-serif;}
      .tra{border-right: 0px solid !important;}
      .trl{text-align: right; font-weight: 700; font-style: italic; font-size: 10px!important; border-right: 0px solid !important; border-left: 0px solid !important;}
    </style>
    <body>
      <div id="header"><?php  $image = 'images/logo.png'; $imageData = base64_encode(file_get_contents($image)); $src = 'data:'.mime_content_type($image).';base64,'.$imageData;  echo '<img src="',$src,'" width="325" height="90" style="float:left; padding-right: 20px;">'; ?>
           <h2 class="titulo2"><strong>{{ $supermarket->name }}</strong></h2></div>
      <div id="footer"><p class="page">Pag </p></div>

      <div class="container">
            <div class="row">
                    <div>
                          <h2 class="h">{{ $supermarket->name }} supermarket</h2>
                          <h3 class="h">{{ $supermarket->address }}</h3>
                          <h5 class="h">PAYROLL REPORT</h5>
                    </div>
                                <div class="col-12" style="text-align: right;">
                                  <ul style="list-style:none">
                                    <li>Week start: {{ $date_begin }}</li>
                                    <li>Week end: {{ $date_end }}</li>
                                  </ul>
                                </div>
                                <div class="clear"></div>
                                <div style="font-size: 11px !important; page-break-after:always;">
                                    @if(!empty($department))
                                        @foreach($payrollInfo as $key => $dep)
                                            <div style="width: 100%">
                                              <div style="padding: 0;">
                                                    <table class="table " style="width: 100%;">
                                                        <thead class="tbro">
                                                        <tr>
                                                          <td colspan="19" class="tbro1">  {{ $key }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ocultar">Control</th>
                                                            <th  >Employee Name</th>
                                                            <th  >Type of Salary</th>
                                                            <th  >Total of Work Hours</th>
                                                            <th  >Reg Hours</th>
                                                            <th  >Hourly Rate</th>
                                                            <th  >OT Work Hours</th>
                                                            <th  >OT Rate</th>
                                                            <th style="display:none;" >TPO Hours now</th>
                                                            <th  >Gross Wage</th>
                                                            <th  >Overtime Wage</th>
                                                            <th  >PTO Amount Paid</th>
                                                            <th  >Total Wage</th>
                                                            <th  >Bonus</th>
                                                            <th  >ADP Gross Pay</th>
                                                            <th  >ADP Net Pay</th>
                                                            <th  >Taxes</th>
                                                            <th  >DD</th>
                                                            <th  >Net Wage</th>
                                                            <th  >Cash</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody style="font-size: 9px !important;">
                                                        <?php $b=true; ?>
                                                        @foreach($dep as $empde)
                                                        <?php if($b==true){ ?><tr class="odd"><?php $b=false; }else{ $b=true; ?><tr><?php } ?>
                                                                <td class="h td1">{{ $empde['control'] }}</td>
                                                                <td class="td1">{{ $empde['name'] }}</td>
                                                                <td class="td1">{{ ucwords($empde['salary_type']) }}</td>
                                                                <td class="h td1">{{ $empde['working_hours'] }}</td>
                                                                <td class="h td1" >{{ $empde['regular_hours'] }}</td>
                                                                <td class="h td1" >{{ '$ '.number_format($empde['pay_hour_pay'],2) }}</td>
                                                                <td class="h td1" >{{$empde['over_time_hour']}}</td>
                                                                <td class="h td1" >{{ '$ '.number_format($empde['over_time_rate'],2) }}</td>
                                                                <td class="h td1" style="display:none;" >{{ $empde['pto'] }}</td>
                                                                <td class="h td1" >{{ '$ '.number_format($empde['gross_wage'],2) }}</td>
                                                                <td class="h td1" >{{ '$ '.number_format($empde['over_time_wage'],2) }}</td>
                                                                <td class="h td1" >{{ '$ '.number_format($empde['pto_amount_paid'],2)}}</td>
                                                                <td class="h td1" >{{ '$ '.number_format($empde['total_wage'],2) }}</td>
                                                                <td class="h td1" >{{ '$ '.number_format($empde['ajust_bonus'],2) }}</td>
                                                                <td class="h td1" >{{ '$ '.number_format($empde['check_gross'],2) }}</td>
                                                                <td class="h td1" >{{ '$ '.number_format($empde['check_net'],2) }}</td>
                                                                <td class="h td1" >{{ '$ '.number_format($empde['taxes'],2) }}</td>
                                                                <td class="h td1" >{{ '$ '.number_format($empde['direct_deposit'],2) }}</td>
                                                                <td class="f td1">{{ '$ '.number_format($empde['net_wage'],2) }}</td>
                                                                <td class="f td1">{{ '$ '.number_format($empde['cash'],2) }}</td>
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


                                <div class="col-12">
                                    <h2 style="text-align: center;">DEPARTMENT NET TOTALS:</h2>
                                    <div class="card-body" style="text-align: center;" >
                                        <table class="table table-bordered" cellpadding="5px" cellspacing="5px" style="width:100%;">
                                          <?php $b=true; ?>
                                            @foreach($totales['total_por_departamento'] as $key => $paySet)
                                             <?php if($b==true){ ?><tr class="odd1"><?php $b=false; }else{ $b=true; ?><tr><?php } ?>
                                                    <td class="tda tra">{{ $key }}</td>
                                                    <td class="trl">({{ $totales['porcentaje_total_por_departamento'][$key] }}%)</td>
                                                    <td ><div class="diva">{{ '$     '.number_format($paySet,2) }}</div></td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td class="tda" colspan="2" style="background-color: #ffc107;">Gross Total:</td>
                                                <td class="tdb" style="background-color:#f5ce99;"> <div class="diva ip" id="total_gross_id">
                                                        <span><strong>{{ '$     '.number_format($totales['total_gross_wage'],2, '.',',') }}</strong></span>
                                                    </div></td>
                                            </tr>
                                            <tr>
                                                <td class="tda" colspan="2">Taxes Total:</td>
                                                <td class="tdb"><div class="diva">
                                                        <span><strong>{{ '$     '.number_format($totales['total_taxes'],2, '.',',') }}</strong></span>
                                                    </div></td>
                                            </tr>
                                            <tr>
                                                <td class="tda"  colspan="2" style="background-color: #28a745;">Net Total:</td>
                                                <td class="tdb" style="background-color:orange;"> <div class="diva ip">
                                                        <span><strong>{{ '$     '.number_format($totales['total_net_wage'],2, '.',',') }}</strong></span>
                                                    </div></td>
                                            </tr>
                                            <tr>
                                                <td class="tda" colspan="2">Direct Deposit Total</td>
                                                <td class="tdb"><div class="diva">
                                                        <span><strong>{{ '$     '.number_format($totales['total_direct_deposit'],2, '.',',') }}</strong></span>
                                                    </div></td>
                                            </tr>
                                            <tr>
                                                <td class="tda"colspan="2"  style="background-color: #28a745;">Cash Needed for this Period</td>
                                                <td class="tdb"  style="background-color:orange;" ><div class="diva ip">
                                                        <span><strong>{{ '$     '.number_format($totales['total_cash'],2, '.',',') }}</strong></span>
                                                    </div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>
        </div>
    </body>
</html>
<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new DOMPDF();
$dompdf->set_paper("A4", "landscape");
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = $supermarket->name." ".date("Y-m-d h:i");
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>
