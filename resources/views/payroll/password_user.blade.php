@extends('layout.payroll_app')

@section('style')
  
@endsection

@section('content')
    <div class="">
          <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">
                        <div class="centar_horizontal">
                            <h3 class="th3">Password {{$user['name']}}</h3>
                           </div>
                           <div class="row">
                             <div class="col-sm-8 offset-md-2">
                              <div class="x_panel">
                                <div class="x_title">
                                  <h2><i class="fa fa-lock"></i> Change <small> Password</small></h2>
                                  <ul class="nav navbar-right panel_toolbox"><li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li></ul>
                                  <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                  <br>
                            <form method="post" action="{{ route('change_password_user', ['id' => $user['id']]) }}">
                                @csrf
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
                                  <hr/>
                                <div class="float-right">
                                    <a href="{{ route('modify_user', ["id" => $user['id']]) }}" class="btn btn-danger by"><i class="fa fa-close"></i> Cancel</a>
                                    <button type="submit" class="btn btn-primary by"><i class="fa fa-edit"></i> Modify</button>
                                </div>
                                <div class="clear"></div>
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
    </div>
  </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/supermarket.js') }}"></script>
@endpush
