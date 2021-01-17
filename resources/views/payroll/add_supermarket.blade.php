@extends('layout.payroll_app')

@section('style')

@endsection

@section('content')
    <div class="container">
                        <div class="centar_horizontal">
                            <h3 class="th3">Supermarket Information</h3>

                            <div class="row" style="justify-content: center;">
                                    <div class="col-md-6 col-sm-6 ">
                                      <div class="x_panel">
                                        <div class="x_title">
                                          <h2><i class="fa fa-shopping-cart"></i> Add <small>Supermarket</small></h2>
                                          <ul class="nav navbar-right panel_toolbox"><li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li></ul>
                                          <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                          <form method="post" action="{{ route('adding_supermarket') }}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                                               @csrf
                                            <div class="form-group row">
                                              <label class="control-label col-md-2 col-sm-2" for="inputName">{{ __('Name:') }}</label>
                                              <div class="col-md-10 col-sm-10 ">
                                                <input  type="text" class="form-control @error('inputName') is-invalid @enderror" id="inputName" name="inputName" value="{{ old('inputName')}}" required autocomplete="inputName" autofocus>
                                                  <span class="fa fa-shopping-cart form-control-feedback right" aria-hidden="true"></span>
                                                @error('inputName')
                                                   <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                              <label class="control-label col-md-2 col-sm-2" for="inputAddress">{{ __('Adress:') }}</label>
                                              <div class="col-md-10 col-sm-10 ">
                                                <input  type="text" class="form-control @error('inputAddress') is-invalid @enderror" id="inputAddress" name="inputAddress" value="{{old('inputAddress')}}" required autocomplete="inputAddress">
                                                  <span class="fa fa-location-arrow form-control-feedback right" aria-hidden="true"></span>
                                                @error('inputAddress')
                                                   <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                              </div>
                                            </div>
                                                <hr/>
                                                <div class="float-right">
                                                        <button type="submit" class="btn btn-primary by"><i class="fa fa-save"></i> {{ __('Submit') }}</button>
                                                </div>
                                            </form>
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
