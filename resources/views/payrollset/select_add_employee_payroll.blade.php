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
                        <div class="centar_horizontal"><h3 class="th3">Select employee to add to the payroll from {{ $supermarket['name'] }}</h3></div>

                        <div class="col-sm-6 offset-md-3">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-calendar"></i> Employee</h2>
                                    <ul class="nav navbar-right panel_toolbox"><li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li></ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br>
                                    <form method="post" action="{{ route('add_employee_to_payroll', ['id_supermarket' => $supermarket['id']]) }}" class="form-horizontal form-label-left">
                                        @csrf
                                        <div class="form-group row">
                                            <input type="hidden" id="date" name="date" value="{{ $date }}">
                                            <input type="hidden" id="id_super" name="id_super" value="{{ $id_supermarket }}">
                                            <select class="custom-select" id="employee_id" name="employee_id">
                                                @foreach($employee as $emp)
                                                <option value="{{ $emp->id }}">{{ $emp->name }} {{ $emp->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <hr>
                                        <div class="float-right">
                                            <a href="{{ route('view_payroll_info', ['date' => $date_begin]) }}" class="btn btn-danger by"><i class="fa fa-close"></i> Cancel</a>
                                            <button type="submit" class="btn btn-primary by"><i class="fa fa-edit"></i>  Enter</button>
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


                </div>
            </div>
        </div>

    </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/gijgo.min.js') }}"></script>
{{--    <script>--}}
{{--        $( function() {--}}
{{--            $('#inputDate').datepicker({ uiLibrary: 'bootstrap4',  disableDaysOfWeek: [1, 2, 3, 4, 5, 6] });});--}}
{{--    </script>--}}
@endpush
