@extends('layout.payroll_app')

@section('style')
<link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link href="{{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<style>
 .x_panel{margin-bottom: 0px;}
 </style>
    <div class="">
        <div class="clearfix"></div>
        <div class="row" style="justify-content: center;">
            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">
                        <div class="centar_horizontal">
                            <h3 class="th3"><span class="th3ex">User List </span></h3>
                        </div>
                        @if(empty($info))
                            <h4>There is no user registed</h4>
                        @else
                          <div class="x_panel x_panel1 scroller">
                        <div class="x_title">
                       <h2><i class="fa fa-user"></i> User <small> List</small></h2>
                          <div class="nav navbar-right" style="width: auto; justify-content: flex-end;">
                            <a href="{{ route('add_user') }}" class="btn btn-primary by by1"><i class="fa fa-save"></i> Add user</a>
                          </div>
                           <div class="clearfix"></div>
                          </div>
                        <div class="row">
                       <div class="col-sm-12">
                                <table id="supermarket_list_id" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Level</th>
                                        <th>Modify</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($info as $inf)
                                        <tr>
                                            <td>{{ $inf['name'] }}</td>
                                            <td>{{ $inf['username'] }}</td>
                                            <td>{{ $inf['email'] }}</td>
                                            <td>{{ $inf['status'] }}</td>
                                            <td>{{ $inf['level'] }}</td>
                                            <td><a href="{{ route('modify_user', ['id' => $inf['id']]) }}" class="btn btn-primary by by1"><i class="fa fa-edit"></i> Modify</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                          </div>
                        </div>
                        @endif
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
         $(document).ready(function() {$('#supermarket_list_id').DataTable();});
    </script>
@endpush
