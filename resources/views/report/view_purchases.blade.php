@extends('layout.payroll_app')

@section('style')
    <link href="{{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">

@endsection

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row" style="justify-content: center;">
            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <div class="centar_horizontal"><h3 class="th3"> Purchases</h3></div>
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-shopping-cart"></i> Purchase <small>table</small></h2>
                                    <div class="nav navbar-right" style="width: auto; justify-content: flex-end;">
                                        <a href="{{ route('add_purchase', ['id' => $id_supermarket]) }}" class="btn btn-primary by"><i class="fa fa-save"></i> Add Purchase</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        @if(empty($info))
                                            <h4>There is no purchase registed</h4>
                                        @else
                                        <table id="purchase_list_id" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>Depatment</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Modify</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($info as $inf)
                                                <tr>
                                                    <td>{{ $inf['department_report'] }}</td>
                                                    <td>{{ $inf['date_f'] }}</td>
                                                    <td>{{ $inf['amount'] }}</td>
                                                    <td>{{ $inf['status'] }}</td>
                                                    <td><a href="{{ route("modify_purchase", ["id_purchase" => $inf['id'], "id_supermarket" => $inf['supermarket_id'] ]) }}" class="btn btn-primary by"><i class="fa fa-edit"></i> Modify</a></td>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        @endif
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
    <script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('vendors/pdfmake/build/vfs_fonts.js') }}"></script>

    <script>
        $(document).ready(function() { $('#purchase_list_id').DataTable();} );
    </script>
@endpush
