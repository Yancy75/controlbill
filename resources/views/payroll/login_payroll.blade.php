@extends('layout.welcome')
@section('content')

    <div class="container">
                        <div class="centar_horizontal">
                            <h3 class="th3"><span class="th3ex">Welcome to Payroll module</span></h3>

                            <div class="row" style="justify-content: center;">
                                    <div class="col-lg-6 col-md-8 col-sm-10  ">
                                      <div class="x_panel" style="    max-width: 620px;">
                                        <div class="x_title">
                                        <!--  <h2>Login <small>Payroll</small></h2>-->
                                              <h2 style="text-align: left; font-weight: 500;">Login <span>Payroll</span></h2>
                                          <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                          </ul>
                                          <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                          <br>

                                          <form method="POST" action="{{ route('login') }}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                                               @csrf
                                            <div class="item form-group">
                                              <label class="col-form-label col-md-3 col-sm-3 col-3 label-align" for="username">{{ __('Username') }}</label>
                                              <div class="col-md-7 col-sm-7 ">
                                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                                @error('username')
                                                   <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                              </div>
                                            </div>

                                            <div class="item form-group">
                                              <label class="col-form-label col-md-3 col-sm-3 col-3 label-align" for="password">{{ __('Password') }}</label>
                                              <div class="col-md-7 col-sm-7 ">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                @error('password')
                                                 <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                                 </span>
                                                @enderror
                                              </div>
                                            </div>
                                            <div class="ln_solid"></div>
                                            <div class="item form-group">
                                              <div class="col-md-6 col-sm-6 offset-sm-6 offset-md-6">
                                                  <button type="submit" class="btn btn-primary by">{{ __('Login') }}</button>
                                              </div>
                                            </div>

                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            </div>
    </div>
@endsection
