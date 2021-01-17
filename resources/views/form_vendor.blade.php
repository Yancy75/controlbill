@extends('layout.app')

@section('style')
    <link href="{{ asset('js/jquery-ui-1.12.1/jquery-ui.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="th3">Add Vendors</h3>
                    </div>

                    <div class="panel-body imagenInicio">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2><i class="fa fa-android"></i> Add Vendors</h2>
                          <ul class="nav navbar-right panel_toolbox"><li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li></ul>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                        <form method="post" action="{{route('addVendor')}}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Vendor</label>
                                <input type="text" class="form-control" id="vendor_id" placeholder="vendor's name" name="vendor">
                            </div>
                            <button type="submit" class="btn btn-primary by"><i class="fa fa-save"></i> Submit</button>
                        </form>
                      </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
