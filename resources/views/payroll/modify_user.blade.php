@extends('layout.payroll_app')

@section('style')

@endsection

@section('content')
    <div class="">
          <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="centar_horizontal">
                            <h3 class="th3">Modify {{$user['name']}} </h3>
                              </div>
                      <div class="row">
                        <div class="col-sm-8 offset-md-2">
                         <div class="x_panel">
                           <div class="x_title">
                             <h2><i class="fa fa-user"></i> Modify <small> Users</small></h2>
                             <ul class="nav navbar-right panel_toolbox"><li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li></ul>
                             <div class="clearfix"></div>
                           </div>
                           <div class="x_content">
                             <br>
                            <form class="form-horizontal form-label-left" method="post" action="{{ route('modifying_user', ['id' => $user['id']]) }}">
                                @csrf
                                <div class="form-group row">
                                  <label class="control-label col-md-2 col-sm-2" for="inputName">{{ __('Name:') }}</label>
                                  <div class="col-md-10 col-sm-10 ">
                                    <input  type="text" class="form-control @error('inputName') is-invalid @enderror" id="inputName" name="inputName" value="{{$user['name']}}" required autocomplete="inputName" autofocus>
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                    @error('inputName')
                                       <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="control-label col-md-2 col-sm-2" for="inputUsername">{{ __('Username:') }}</label>
                                  <div class="col-md-10 col-sm-10 ">
                                    <input  type="text" class="form-control @error('inputUsername') is-invalid @enderror" id="inputUsername" name="inputUsername" value="{{$user['username']}}" required autocomplete="inputUsername" autofocus>
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                    @error('inputUsername')
                                       <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="control-label col-md-2 col-sm-2" for="inputEmail">{{ __('Email:') }}</label>
                                  <div class="col-md-10 col-sm-10 ">
                                    <input  type="email" class="form-control @error('inputEmail') is-invalid @enderror" id="inputEmail" name="inputEmail" value="{{$user['email']}}" required autocomplete="inputEmail" autofocus>
                                    <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
                                    @error('inputEmail')
                                       <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputStatus">Status:</label>
                                      <div class="col-md-10 col-sm-10 ">
                                    <select class="form-control" id="inputStatus" name="inputStatus" style="border-radius: 5px;">
                                        @if($user['status'] == 'active')
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        @else
                                            <option value="inactive">Inactive</option>
                                            <option value="active">Active</option>
                                        @endif
                                    </select>
                                  </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputLevel">Level:</label>
                                    <div class="col-md-10 col-sm-10 ">
                                    <select class="form-control" id="inputLevel" name="inputLevel" style="border-radius: 5px;">
                                        @if($user['level'] == 'admin')
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        @else
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                        @endif
                                    </select>
                                  </div>
                                </div>
                                <hr/>
                                <div class="float-left resaltado">
                                    <a href="{{ route('password_user', ['id' => $user['id']]) }}" class="btn btn-success btn-lg by"><i class="fa fa-lock"></i> Password</a>
                                </div>
                                <div class="float-right">
                                    <a href="{{ route('user_list') }}" class="btn btn-danger by"><i class="fa fa-close"></i> Cancel</a>
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
