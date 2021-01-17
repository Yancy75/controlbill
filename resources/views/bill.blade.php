@extends('layout.app')

@section('style')
<link href="{{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
<style>
.centrado{
padding-bottom: 2em;
display: flex;
justify-content: center;
}
.imgg{
  border-radius: 50%;
    width: 100px;
    box-shadow: 0px 0px 6px black;
    border: 4px solid gold;
}
</style>
@endsection

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body imagenInicio">
                        <h3 class="th3">Welcome to produces invoice control system</h3>
                        <div class="row">
                            <div class="col-sm-8 offset-md-2">
                             <div class="x_panel">
                               <div class="x_title">
                                <h2><i class="fa fa-globe"></i> Invoice <small>Control</small></h2>
                                <div class="clearfix"></div>
                                 </div>
                        <form>
                            <div class="form-group">
                                @csrf
                                <input type="hidden" id="rutaSearchStore" value="{{ route('searchStore') }}"/>
                                <input type="hidden" id="rutaSearchPLU" value="{{ route('searchPLU') }}"/>
                                <input type="hidden" id="rutaSearchVendor" value="{{ route('searchVendor') }}"/>
                                <input type="hidden" id="rutaAddProductToBill" value="{{ route('rutaAddProductToBill') }}"/>
                                <input type="hidden" id="rutaSearchProductsBillOpen" value="{{ route('rutaSearchProductsBillOpen') }}"/>
                                <input type="hidden" id="rutaDeleteEntrance" value="{{ route('rutaDeleteEntrance') }}"/>
                                <input type="hidden" id="rutaSaveProductsBillOpen" value="{{ route('rutaSaveProductsBillOpen') }}"/>
                                <label for="storeCode">Please insert the code of the store</label>
                                <input type="text" class="form-control" id="storeCode" aria-describedby="emailHelp" placeholder="Enter the code">
                            </div>

                            <button type="button" class="btn btn-primary by" onclick="searchStore();"><i class="fa fa-search"></i> Search</button>
                        </form>
                      </div>
                    </div>
                  </div>

                        <div class='clear'></div>
                        <div class="centrado">
                           <div class="ocultar" id="loading_image_1">
                              <img class="imgg" src="{{asset("images/loading.gif")}}">
                           </div>
                        </div>
                        <div id="mensaje_store_search"></div>
                        <div id="contenido_descripcion_tienda"></div>
                        <div id="contenido_form_tienda"></div>

                        <div id="contenido_list_product_bill" class="ocultar mt-3">
                          <!--  <div class="float-right">
                                <label for="totalCompra">Total</label>
                                <input type="number" id="totalCompra" value="0" disabled/>
                            </div>-->
                            <div class="clear"></div>
                             <div class="x_panel">
                            <table id="list_products" class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>PLU</th>
                                        <th>Description</th>
                                        <th>Box Qty</th>
                                        <th>Vendor Price</th>
                                        <th>Product Amount</th>
                                        <th>Type</th>
                                        <th>Vendor Unit Price</th>
                                        <th>Vendor Total Price</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                            <hr>
                            <div class="float-right" style="padding-right: 15px;">
                                <button type="button" class="btn btn-primary by" onclick="saveProductListBill();"><i class="fa fa-save"></i> Save</button>
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
<script src="{{ asset('js/bills.js') }}"></script>
<script>
$(document).ready(function() {
  $('#list_products').DataTable();
  $("form").on("submit", false);
  $("#storeCode").on("keypress", function (e) {
      if (e.keyCode == 13) {
          searchStore();
      }
  });
});
</script>
@endpush
