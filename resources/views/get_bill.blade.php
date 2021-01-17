@extends('layout.app')

@section('style')
<link href="{{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/gijgo.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body imagenInicio">
                        <div id="fechas">
                            <form>
                                @csrf
                                <input type="hidden" id="rutaSearchVendor" value="{{ route('searchVendor') }}"/>
                                <input type="hidden" id="rutaSearchBills" value="{{ route('rutaSearchBills') }}"/>
                                <div class="form-group row">
                                    <label for="tiendaCode" class="col-sm-1 col-form-label">Store</label>
                                    <div class="col-sm-2 mr-1">
                                        <input type="text" class="form-control" id="tiendaCode" placeholder="Store">
                                    </div>
                                    <label for="fecha_i" class="col-sm-1 col-form-label">Date</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="fecha_i" placeholder="Date">
                                    </div>
                                    <label for="fecha_f" class="col-sm-1 col-form-label">Date</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="fecha_f" placeholder="Date">
                                    </div>
                                    <label for="inputVendor">Vendor</label>
                                    <div class="col-sm-2">
                                        <select id="inputVendor" class="form-control">
                                            <option value="0" selected>All</option>
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-primary by mb-2" onclick="searchBill();"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </form>
                            <div id="mensaje_id"></div>
                        </div>
                       <hr/>
                       <div class="x_panel">
                        <div id="divTable">
                            <table id="id_table_list_bills" class="table table-striped thead-dark">
                                <thead>
                                    <tr>
                                        <th>Store</th>
                                        <th>Vendor</th>
                                        <th class='ocultar'>Item</th>
                                        <th>Description</th>
                                        <th>QTY</th>
                                        <th>Price</th>
                                        <th>Product Amount</th>
                                        <th>Unit</th>
                                        <th>Date</th>
                                        <th>Unit price</th>
                                        <th>Total price</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
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
    <script src="{{ asset('js/get_bills.js') }}"></script>
    <script src="{{ asset('js/gijgo.min.js') }}"></script>
    <script>
        $(function () {
          $('#fecha_i').datepicker({
             uiLibrary: 'bootstrap4',
             iconsLibrary: 'fontawesome',
             maxDate: function () {return $('#fecha_f').val();}
                                   });
    $('#fecha_f').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        minDate: function () { return $('#fecha_i').val();}
                            });

       $('#id_table_list_bills').DataTable();



            getVendor();
            $("form").on("submit", false);

        });


    </script>
@endpush
