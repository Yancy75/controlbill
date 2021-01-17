@extends('layout.app')

@section('style')
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
                                <input type="hidden" id="rutaSearchBills" value="{{ route('rutaSearchReports2') }}"/>
                                <div class="form-group row">
                                    <label for="input_plu">PLU</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="input_plu" placeholder="PLU">
                                    </div>
                                    <label for="fecha_i" class="col-sm-1 col-form-label">Date start</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="fecha_i" placeholder="Date">
                                    </div>
                                    <label for="fecha_f" class="col-sm-1 col-form-label">Date end</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="fecha_f" placeholder="Date">
                                    </div>

                                    <button type="button" class="btn btn-primary by mb-2" onclick="searchReportPlu();"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </form>
                            <div id="mensaje_id"></div>
                        </div>

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
@endsection

@push('scripts')
    <script src="{{ asset('js/get_bills.js') }}"></script>
    <script src="{{ asset('js/gijgo.min.js') }}"></script>

    <script>
        $(function () {
           $('#fecha_i').datepicker({ uiLibrary: 'bootstrap4', iconsLibrary: 'fontawesome', maxDate: function () {return $('#fecha_f').val();}});
           $('#fecha_f').datepicker({ uiLibrary: 'bootstrap4', iconsLibrary: 'fontawesome', minDate: function () { return $('#fecha_i').val();}});

            $('.ui-datepicker').addClass('notranslate');

            $("#fecha_i").change(function () {
                // validateDate();
            });

            $("#fecha_f").change(function () {
                validateDate();
            });
            getVendor();
            $("form").on("submit", false);

        });
        $('#id_table_list_bills').DataTable();
        // $('#id_table_list_bills').DataTable();
    </script>
@endpush
