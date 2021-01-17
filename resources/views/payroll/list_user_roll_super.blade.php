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
        <div class="row">
            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">
                        <div class="centar_horizontal">
                            <h3  class="th3">{{ $supermarket['name'] }} Supermarket Roll User</h3>
                        </div>
                        @if(empty($info))
                            <h4>There is no user registed</h4>
                        @else

                          <div class="row">
                            <div class="col-sm-8 offset-md-2">
                              <div class="x_panel">
                                 <div class="x_title">
                                 <h2><i class="fa fa-shopping-cart"></i> Roll <small><i class="fa fa-user"></i> User</small></h2>
                                    <div class="clearfix"></div>
                                  </div>
                                <table id="supermarket_list_id" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Level</th>
                                        <th>Roll</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($info as $inf)
                                        <tr>
                                            <td>{{ $inf['name'] }}</td>
                                            <td>{{ $inf['level'] }}</td>
                                            @if($inf['roll_id'] == 0)
                                                <td><a href="{{ route('roll_in', ['user_id' => $inf['user_id'], 'supermarket_id' => $inf['supermarket_id']]) }}" class="btn btn-primary by">Roll In</a></td>
                                            @else
                                                <td><a href="{{ route('roll_out', ['id' => $inf['roll_id']]) }}" class="btn btn-danger by">Roll Out</a></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        @endif
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
    <script src="{{ asset('js/supermarket.js') }}"></script>
    <script>
    $(document).ready(function() {
       $('#supermarket_list_id').DataTable();
       var table = $('#supermarket_list_id').DataTable();
        table.columns.adjust().draw();

    });
    </script>
@endpush
