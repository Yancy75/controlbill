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
            <div class="col-md-12 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">
                        <div class="centar_horizontal">
                            <input type="hidden" id="supermarket_id_id" value="{{ $supermarket['id'] }}">
                            <h3  class="th3">Employee List of {{ $supermarket['name'] }}</h3>
                        </div>
                        @if(empty($info))
                            <div class="centar_horizontal">
                                <h4>There is no employee registed</h4>
                                <a href="{{ route('add_employee', ['id_supermarket' => $supermarket['id']]) }}" class="btn btn-success by"><i class="fa fa-save"></i> Add Employee</a>
                            </div>
                        @else
                              <div class="x_panel">
                                <div class="x_title">
                               <h2><i class="fa fa-shopping-cart"></i> Supermarket <small>table</small></h2>
                                  <div class="nav navbar-right" style="width: auto; justify-content: flex-end;">
                                      <div class="width_50_porcent">
                                          <select class="form-control form-control-sm width_30_porcent" id="view_by_status_id">
                                              @if($view == 'a')
                                                  <option value="a">Active</option>
                                                  <option value="al">All</option>
                                                  <option value="t">Terminated</option>
                                              @elseif($view == 'al')
                                                  <option value="al">All</option>
                                                  <option value="a">Active</option>
                                                  <option value="t">Terminated</option>
                                              @elseif($view == 't')
                                                  <option value="t">Terminated</option>
                                                  <option value="a">Active</option>
                                                  <option value="al">All</option>
                                              @endif
                                          </select>
                                      </div>
                                      <a href="{{ route('add_employee', ['id_supermarket' => $supermarket['id']]) }}" class="btn btn-success by"><i class="fa fa-save"></i> Add Employee</a>
                                    </div>
                                   <div class="clearfix"></div>
                                  </div>
                                  <div class="row">
                                 <div class="col-sm-12">
                                <table id="supermarket_list_id" class="table table-striped table-bordered" style="width:100%; font-size: 13px !important;">
                                    <thead>
                                    <tr>
                                        <th>Name (First, Last)</th>
                                        <th>Address</th>
                                        <th>Mobil</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                        <th>View</th>
                                        <th>Modify</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($info as $inf)
                                        <tr>
                                            <td>{{ $inf['empname'] }}  {{ $inf['last_name'] }}</td>
                                            <td>
                                                {{ $inf['address'] }} {{ $inf['city'] }}
                                                @if(!is_null($inf['state']))
                                                , {{ $inf['state'] }}
                                                @endif
                                                @if(!is_null($inf['zip_code']))
                                                , {{ $inf['zip_code'] }}
                                                    @endif
                                            </td>
                                            <td>{{ preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $inf['mobil']) }}</td>
                                            <td>{{ $inf['depname'] }}</td>
                                            <td>
                                                @if($inf['empstatus'] == 'inactive')
                                                    Terminated
                                                @else
                                                    {{ ucwords($inf['empstatus']) }}

                                                @endif

                                            </td>
                                            <td><a href="{{ route('modify_employee', ['id' => $inf['emplid'], 'view_modify' => 'v']) }}" class="btn btn-sm btn-primary by" style="min-width: 30px !important;"><i class="fa fa-eye"></i></a></td>
                                            <td><a href="{{ route('modify_employee', ['id' => $inf['emplid'], 'view_modify' => 'm']) }}" class="btn btn-sm btn-primary by" style="min-width: 30px !important;"><i class="fa fa-edit"></i></a></td>
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
        $(document).ready(function() {
            $('#supermarket_list_id').DataTable();
            $('#view_by_status_id').change( function ()
                {
                    console.log( );
                    if(this.value == 'a')
                    {
                        window.location.href = "{{route('employees_list', ['id_supermarket' => session()->get('supermarket_id'), 'view' => 'a'])}}";

                    }
                    else if(this.value == 'al')
                    {
                        window.location.href = "{{route('employees_list', ['id_supermarket' => session()->get('supermarket_id'), 'view' => 'al'])}}";

                    }
                    else if(this.value == 't')
                    {
                        window.location.href = "{{route('employees_list', ['id_supermarket' => session()->get('supermarket_id'), 'view' => 't'])}}";

                    }
                });
        } );
    </script>
    <script>

    </script>
@endpush
