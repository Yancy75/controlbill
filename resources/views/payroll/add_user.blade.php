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
                          <h3 class="th3"><span class="th3ex">Supermarket Information</span></h3>
                         </div>

                         <div class="row" style="justify-content: center;">
                           <div class="col-11 col-sm-10 col-md-8 col-lg-7">

                            <div class="x_panel">
                              <div class="x_title">
                                <h2><i class="fa fa-user"></i> Add Users</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                  <li><a href="{{ route('user_list') }}" ><span class="btn btn-primary by" style="color:white;"><i class="fa fa-sign-out" aria-hidden="true"></i> Back</span></a><li>
                                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
                                </ul>
                                <div class="clearfix"></div>
                              </div>
                              <div class="x_content">
                                <br>
                            <form method="post" action="{{ route('adding_user') }}">
                                @csrf
                                <div class="form-group row">
                                  <label class="control-label col-md-2 col-sm-2" for="inputName">{{ __('Name:') }}</label>
                                  <div class="col-md-10 col-sm-10 ">
                                    <input  type="text" class="form-control @error('inputName') is-invalid @enderror" id="inputName" name="inputName"  required autocomplete="inputName" autofocus placeholder="Name...">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                    @error('inputName')
                                       <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="control-label col-md-2 col-sm-2" for="inputUsername">{{ __('Username:') }}</label>
                                  <div class="col-md-10 col-sm-10 ">
                                    <input  type="text" class="form-control @error('inputUsername') is-invalid @enderror" id="inputUsername" name="inputUsername"  required autocomplete="inputUsername" autofocus placeholder="Username...">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                    @error('inputUsername')
                                       <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="control-label col-md-2 col-sm-2" for="inputEmail">{{ __('Email:') }}</label>
                                  <div class="col-md-10 col-sm-10 ">
                                    <input  type="email" class="form-control @error('inputEmail') is-invalid @enderror" id="inputEmail" name="inputEmail"  required autocomplete="inputEmail" autofocus  placeholder="Email...">
                                    <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
                                    @error('inputEmail')
                                       <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="control-label col-md-2 col-sm-2" for="inputPassword">{{ __('Password:') }}</label>
                                  <div class="col-md-10 col-sm-10 ">
                                    <input  type="password" class="form-control @error('inputPassword') is-invalid @enderror" id="inputPassword" name="inputPassword"  required autocomplete="inputPassword" autofocus  placeholder="Password...">
                                    <span class="fa fa-lock form-control-feedback right" aria-hidden="true"></span>
                                    @error('inputPassword')
                                       <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="control-label col-md-2 col-sm-2" for="inputLevel">Level:</label>
                                   <div class="col-md-10 col-sm-10 ">
                                    <select class="form-control" id="inputLevel" name="inputLevel" style="border-radius: 5px;">
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                  </div>
                                </div>
                                <hr/>
                                  <div class="float-right">
                                    <button type="submit" class="btn btn-primary by"><i class="fa fa-save"></i> Submit</button>
                                   </div>
                            </form>
                           </div>
                          </div>
                        </div>
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
@endsection

@push('scripts')
    <script src="{{ asset('js/supermarket.js') }}"></script>
@endpush
