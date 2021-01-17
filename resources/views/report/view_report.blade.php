@extends('layout.payroll_app')

@section('style')
    <link href="{{ asset('css/gijgo.min.css') }}" rel="stylesheet">
    <style>
        .btn-outline-secondary{
            margin-bottom: 0px;
        }
        .disabled{
            background: lightgray;
            border: 1px solid white;
        }
        .gj-cursor-pointer > div{
            font-weight: 700;
        }
        .gj-cursor-pointer:hover > div{
            background: blue !important;
            color: white !important;
            text-shadow: 1px 1px 2px black;
        }
    </style>
@endsection

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="centar_horizontal"><h3 class="th3">Select period for the report of {{ $supermarket['name'] }}</h3></div>
                        <div class="col-sm-6 offset-md-3">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-calendar"></i> Period</h2>
                                    <ul class="nav navbar-right panel_toolbox"><li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li></ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br>
                                    <form method="post" action="{{ route('calcular_report', ['id_supermarket' => $supermarket['id']]) }}" class="form-horizontal form-label-left">
                                        @csrf
                                        <input type="hidden" id="inputIdSupermarket" name="inputIdSupermarket" value="{{$supermarket['id']}}">
                                        <div class="form-group row">
                                            <input id="inputDate" class="inputDate"  placeholder="Start..." name="inputDate" autocomplete="off"/>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <input id="inputDatef" class="inputDate"  placeholder="End..." name="inputDatef" autocomplete="off"/>
                                        </div>
                                        <hr>
                                        <div class="float-right">
                                            <a href="{{ url('Dashboard_payroll') }}" class="btn btn-danger by"><i class="fa fa-close"></i> Cancel</a>
                                            <button type="submit" class="btn btn-primary by" disabled="disabled"><i class="fa fa-edit"></i>  Enter</button>
                                        </div>
                                        <div class="clear"></div>
                                    </form>
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
                                    <div class="clear"></div>
                                    <div id="mensaje_id" class="alert alert-danger ocultar">
                                        <spam id="mensaje_spam" style="font-size: 20px;"></spam>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        @if($info)
                            <div id="reporte_general_id" class="x_panel">
                                Report to {{$datei}} until {{$datef}}
                                <br/>
                                Total Payroll: {{ $payroll['total'] }}
                                <br/>
                                Total Purchases: {{ $purchase['total'] }}
                                <br/>
                                Total Expenses: {{ $expense['total'] }}
                                <br/>
                                Total Sales: {{ $sale['total'] }}
                                <br/>
                                <br/>
                                Gain: @php
                                echo $sale['total'] - $expense['total'] - $purchase['total'] - $payroll['total'];
                                @endphp
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/gijgo.min.js') }}"></script>
    <script src="{{ asset('js/report_store.js') }}"></script>
    <script>
        $( function() {
            $('#inputDate').datepicker({ uiLibrary: 'bootstrap4' });
            $('#inputDatef').datepicker({ uiLibrary: 'bootstrap4' });
        });
        validarFechaBuscarReporte();
    </script>
@endpush
