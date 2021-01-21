@extends('layout.payroll_app')

@section('style')

    @endsection

@section('content')
<style>
.right{background: white;}
.form-control{padding-right: 2.5em;}
</style>
    <div class="">
        <div class="clearfix"></div>

                <div class="panel panel-default" style="padding-top:5em;">
                    <div class="panel-body">

                        <div class="centar_horizontal">
                              <h3 class="th3"><span class="th3ex">Modify supermarket Crescent</span></h3>
                            </div>
                            <div class="row" style="justify-content: center;">
                              <div class="col-11 col-sm-10 col-md-9 col-lg-8">

                          <div class="x_panel">
                            <div class="x_title">
                              <h2><i class="fa fa-shopping-cart"></i> Modify supermarket</h2>
                              <ul class="nav navbar-right panel_toolbox">
                                    <li><a href="{{ route('supermarket_list') }}" ><span class="btn btn-primary by" style="color:white;"><i class="fa fa-sign-out" aria-hidden="true"></i> Back</span></a><li>
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                              </ul>
                              <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                            <form method="post" action="{{ route('modifying_super', ['id' => $super['id']]) }}" class="form-horizontal form-label-left">
                                    @csrf
                                    <div class="form-group row">
                                      <label class="control-label col-md-2 col-sm-2" for="inputName">{{ __('Name:') }}</label>
                                      <div class="col-md-10 col-sm-10 ">
                                        <input  type="text" class="form-control @error('inputName') is-invalid @enderror" id="inputName" name="inputName" value="{{$super['name']}}" required autocomplete="inputName" autofocus>
                                          <span class="fa fa-shopping-cart form-control-feedback right" aria-hidden="true"></span>
                                        @error('inputName')
                                           <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="control-label col-md-2 col-sm-2" for="inputAddress">{{ __('Adress:') }}</label>
                                      <div class="col-md-10 col-sm-10 ">
                                        <input  type="text" class="form-control @error('inputAddress') is-invalid @enderror" id="inputAddress" name="inputAddress" value="{{$super['address']}}" required autocomplete="inputAddress" autofocus>
                                          <span class="fa fa-location-arrow form-control-feedback right" aria-hidden="true"></span>
                                        @error('inputAddress')
                                           <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                      </div>
                                    </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputStatus">Status:</label>
                                      <div class="col-md-10 col-sm-10 ">
                                    <select class="form-control" id="inputStatus" name="inputStatus" style="border-radius: 5px;">
                                        @if($super['status'] == 'active')
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        @else
                                            <option value="inactive">Inactive</option>
                                            <option value="active">Active</option>
                                        @endif
                                    </select>
                                  </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="float-left resaltado">
                                  <a href="{{ route('department_list', ['id' => $super['id']]) }}" class="btn btn-warning btn-lg by"><i class="fa fa-building-o"></i> Department</a>
                                  <a href="{{ route('roll_user_list', ['id' => $super['id']]) }}" class="btn btn-secondary btn-lg by"><i class="fa fa-user"></i> Roll in</a>
                                </div>
                                <div class="float-right">
                                  <a href="{{ route('supermarket_list') }}" class="btn btn-danger by"><i class="fa fa-close"></i> Cancel</a>
                                  <button type="submit" class="btn btn-primary by"><i class="fa fa-edit"></i> Modify</button>
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
                          </div>
                        </div>
                    </div>
                </div>
              </div>
          </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/supermarket.js') }}"></script>
@endpush
