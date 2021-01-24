<html>
<head>
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap/css/bootstrap-horizon.css') }}" rel="stylesheet">
</head>
<style>
 @page {  margin-top: 150px;  margin-bottom: 80px;  margin-right: 50px;  margin-left: 50px; }
 #header { position: fixed; top: -150px; right: 0px; height: 100px; border-bottom: 2px solid black; text-align: right; font-weight: bold; text-transform: uppercase; padding-top: 5px;}
 #footer { position: fixed; left: 0px; bottom: -80px; right: 0px; height: 60px; text-align: right; padding-right: 20px; border-top: 2px solid black;}
 #footer .page:after { content: counter(page); }
 .titulo2{font-size: 35px !important; font-family:sans-serif; color:#ff711e;}
 .nombre{ font-size: 2.5em;
    font-family: sans-serif;
    font-weight: 800;
    text-decoration: underline;
    text-decoration-color: green;}
 .titu{font-family: sans-serif;}
 .cabe{border-bottom: 2px solid black;}
 .obt{border: 1px solid #dee2e6; border-collapse: collapse !important; padding: 0.2em;}
 .colo{background-color:#ebf1de !important;}
 .gru{font-weight: 800;}
</style>

<body>
  <div id="header"><?php  /* $image = 'images/logo.png'; $imageData = base64_encode(file_get_contents($image)); $src = 'data:'.mime_content_type($image).';base64,'.$imageData;  echo '<img src="',$src,'" width="325" height="90" style="float:left; padding-right: 20px;">';*/ ?>
       <h1 class="titulo2"><strong>{{ $supermarket->name }}</strong></h1></div>
  <div id="footer"><p class="page">Pag </p></div>
    <div class="container">
      <div class="row">
        <?php $ba=false ?>
          @foreach($payroll_info as $dep)
                @foreach($dep as $empde)
                <?php if($ba){ ?><div style="page-break-after:always;"></div><?php }else{ $ba=true;} ?>
                <div class="clear"></div>
                  <div style="width:100%;">
                      <div style="padding: 0;">
                              <table class="table" border="0" style="width: 100%;">
                                  <tbody>
                                    <tr>
                                      <td colspan="2" class="tbro1 titu nombre">{{ $empde['name'] }}</td>
                                      <td style="text-align: right;">
                                        <ul style="list-style:none">
                                          <li>Week Starting: {{ $date_begin }}</li>
                                          <li>Week Ending: {{ $date_end }}</li>
                                        </ul>
                                      </td>
                                    </tr>
                                  <tr>
                                    <td colspan="2" class="tbro1 titu cabe"><h4>PAYROLL  BREAKDOWN:</h4>  </td>
                                    <td rowspan="7">
                                      <div class="float-right" style="font-size: 12px !important;">
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
                                                      <p>You will earn 40 hours PTO on the payroll period staring on 01/03/2021 pica</p>
                                                  @else
                                                      <p>You will earn 40 hours PTO after paco {{ $empde["pto_activation"] }}</p>
                                                  @endif

                                              </div>
                                          @endif
                                      </div>

                                    </td>
                                  </tr>
                                  <tr>
                                      <td class="titu colo obt">GROSS WAGES:</td>
                                      <td class="obt gru">$&nbsp;{{ number_format($empde['gross_wage'],2) }}</td>
                                        </tr>
                                        <tr>
                                      <td class="titu colo obt">OVERTIME WAGES:</td><td class="obt gru">$&nbsp;{{ number_format($empde['overtime_wage'],2)  }}</td>
                                        </tr>
                                        <tr>
                                      <td class="titu colo obt">PTO PAID:</td><td class="obt gru">$&nbsp;{{ number_format($empde['pto'],2) }}</td>
                                        </tr>
                                        <tr>
                                      <td class="titu colo obt">ADJUST/BONUS:</td><td class="obt gru">$&nbsp;{{ number_format($empde['ajust_bonus'],2) }}</td>
                                        </tr>
                                        <tr>
                                      <td class="titu colo obt">TOTAL WAGES:</td><td class="obt gru">$&nbsp;{{ number_format($empde['total_wage'],2)  }}</td>
                                        </tr>
                                        <tr>
                                      <td class="titu colo obt">TAXES:</td><td class="obt gru">$&nbsp;{{ number_format($empde['taxes'],2) }}</td>
                                        </tr>
                                        <tr>
                                      <td class="titu colo obt">NET PAY:</td><td class="obt gru">$&nbsp;{{ number_format($empde['net_pay'],2) }}</td>
                                        </tr>
                                        <tr>
                                      <td colspan="2" class="tbro1 titu cabe"><h4>PAYMENT  BREAKDOWN:</h4></td>
                                        </tr>
                                        <tr>
                                      <td class="titu colo obt">DIRECT DEPOSIT:</td><td class="obt gru">$&nbsp;{{ number_format($empde['direct_deposit']) }}</td>
                                        </tr>
                                      <tr>
                                        <td class="titu colo obt">CASH</td><td class="obt gru">$&nbsp;{{ number_format($empde['cash'],2) }}</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3">
                                          @if($empde['on_book'] != 'none')
                                              <p> To view your payroll taxes breakdown, login to your ADP payroll account</p>
                                            @endif
                                          </td>
                                      </tr>
                                </tbody>
                              </table>
                          </div>
                </div>

            @endforeach
        @endforeach

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
$filename = "ejemplo";
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>
