@extends('layout.payroll_app')

@section('style')
    <link href="{{ asset('css/gijgo.min.css') }}" rel="stylesheet">
    <style>
        .btn-outline-secondary{
            margin-bottom: 0px;
        }
        .disabled{
            background: lightgray;
            border: 1px solid white;
        }
        .gj-cursor-pointer > div{
            font-weight: 700;
        }
        .gj-cursor-pointer:hover > div{
            background: blue !important;
            color: white !important;
            text-shadow: 1px 1px 2px black;
        }
        .right{background: white;}
        .form-control{padding-right: 2.5em;}
        .th3ex{line-height: 3rem;}
    </style>
@endsection

@section('content')

    <div class="">
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                      <div class="panel-body">
                              <div class="centar_horizontal">
                                <h3 class="th3"><span class="th3ex">Employee Information of the supermarket {{ $supermarket['name'] }}</span></h3>
                              </div>
                              <div class="row">
                                <div class="col-sm-8 offset-md-2">
                                 <div class="x_panel">
                                   <div class="x_title">
                                     <h2><i class="fa fa-user"></i> Add Employee</h2>
                                     <ul class="nav navbar-right panel_toolbox"><li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li></ul>
                                     <div class="clearfix"></div>
                                   </div>
                                   <div class="x_content">
                            <form id="add_employee_form_id" method="post" action="{{ route('adding_employee') }}" class="form-horizontal form-label-left">
                                @csrf
                                <input type="hidden" id="inputIdSupermarket" name="inputIdSupermarket" value="{{ $supermarket['id'] }}"/>
                                <div class="form-group row">
                                  <label class="control-label col-md-2 col-sm-2" for="inputName">{{ __('Name:') }}</label>
                                  <div class="col-md-10 col-sm-10 ">
                                    <input  type="text" class="form-control @error('inputName') is-invalid @enderror" id="inputName" name="inputName" placeholder="Name..." required autocomplete="inputName" autofocus>
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                    @error('inputName')
                                       <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="control-label col-md-2 col-sm-2" for="inputLastName">{{ __('Last Name:') }}</label>
                                  <div class="col-md-10 col-sm-10 ">
                                    <input  type="text" class="form-control @error('inputLastName') is-invalid @enderror" id="inputLastName" name="inputLastName" placeholder="LastName..." required autocomplete="inputLastName">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                    @error('inputLastName')
                                       <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="control-label col-md-2 col-sm-2" for="inputAddress">{{ __('Address:') }}</label>
                                  <div class="col-md-10 col-sm-10 ">
                                    <input  type="text" class="form-control @error('inputAddress') is-invalid @enderror" id="inputAddress" name="inputAddress"  placeholder="Address..." autocomplete="inputAddress">
                                      <span class="fa fa-location-arrow form-control-feedback right" aria-hidden="true"></span>
                                    @error('inputAddress')
                                       <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="control-label col-md-2 col-sm-2" for="inputCity">{{ __('City:') }}</label>
                                  <div class="col-md-10 col-sm-10 ">
                                    <input  type="text" class="form-control @error('inputCity') is-invalid @enderror" id="inputCity" name="inputCity" placeholder="City..." autocomplete="inputCity">
                                      <span class="fa fa-building-o form-control-feedback right" aria-hidden="true"></span>
                                    @error('inputCity')
                                       <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputState">{{ __('State:') }}</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <select  class="form-control" id="inputState" name="inputState">
                                            <option value='NY'>NY</option>
                                            <option value='AL'>AL</option>
                                            <option value='AZ'>AZ</option>
                                            <option value='AR'>AR</option>
                                            <option value='CA'>CA</option>
                                            <option value='CO'>CO</option>
                                            <option value='CT'>CT</option>
                                            <option value='DE'>DE</option>
                                            <option value='FL'>FL</option>
                                            <option value='GA'>GA</option>
                                            <option value='ID'>ID</option>
                                            <option value='IL'>IL</option>
                                            <option value='IN'>IN</option>
                                            <option value='IA'>IA</option>
                                            <option value='KS'>KS</option>
                                            <option value='KY'>KY</option>
                                            <option value='LA'>LA</option>
                                            <option value='ME'>ME</option>
                                            <option value='MD'>MD</option>
                                            <option value='MA'>MA</option>
                                            <option value='MI'>MI</option>
                                            <option value='MN'>MN</option>
                                            <option value='MS'>MS</option>
                                            <option value='MO'>MO</option>
                                            <option value='MT'>MT</option>
                                            <option value='NE'>NE</option>
                                            <option value='NV'>NV</option>
                                            <option value='NH'>NH</option>
                                            <option value='NJ'>NJ</option>
                                            <option value='NM'>NM</option>
                                            <option value='NY'>NY</option>
                                            <option value='NC'>NC</option>
                                            <option value='ND'>ND</option>
                                            <option value='OH'>OH</option>
                                            <option value='OK'>OK</option>
                                            <option value='OR'>OR</option>
                                            <option value='PA'>PA</option>
                                            <option value='RI'>RI</option>
                                            <option value='SC'>SC</option>
                                            <option value='SD'>SD</option>
                                            <option value='TN'>TN</option>
                                            <option value='TX'>TX</option>
                                            <option value='UT'>UT</option>
                                            <option value='VT'>VT</option>
                                            <option value='VA'>VA</option>
                                            <option value='WA'>WA</option>
                                            <option value='WV'>WV</option>
                                            <option value='WI'>WI</option>
                                            <option value='WY'>WY</option>
                                        </select>
                                        <span class="fa fa-map form-control-feedback right" aria-hidden="true"></span>
                                        @error('inputCity')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputZip">{{ __('Zip Code:') }}</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <input  type="text" class="form-control @error('inputZip') is-invalid @enderror" id="inputZip" name="inputZip" placeholder="Zip Code..." autocomplete="inputZip">
                                        <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                                        @error('inputZip')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                  <label class="control-label col-md-2 col-sm-2" for="inputMobil">{{ __('Mobil:') }}</label>
                                  <div class="col-md-10 col-sm-10 ">
                                    <input  type="text" class="form-control @error('inputMobil') is-invalid @enderror" id="inputMobil" name="inputMobil" data-inputmask="'mask' : '(999) 999-9999'"  placeholder="Mobil..." autocomplete="inputMobil">
                                      <span class="fa fa-mobile form-control-feedback right" aria-hidden="true"></span>
                                    @error('inputMobil')
                                       <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputEmail">{{ __('Email:') }}</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <input  type="email" class="form-control @error('inputEmail') is-invalid @enderror" id="inputEmail" name="inputEmail" placeholder="Email..." autocomplete="inputEmail">
                                        <span class="fa fa-mobile form-control-feedback right" aria-hidden="true"></span>
                                        @error('inputEmail')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputGender">{{ __('Gender:') }}</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <select class="form-control" id="inputGender" name="inputGender" style="border-radius: 5px;">
                                            <option value="female">Female</option>
                                            <option value="male">Male</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputDepartment">Department:</label>
                                      <div class="col-md-10 col-sm-10 ">
                                    <select class="form-control" id="inputDepartment" name="inputDepartment" style="border-radius: 5px;">
                                        <option value="">None</option>
                                        @if(!empty($department))
                                            @foreach($department as $dep)
                                                <option value="{{ $dep["id"] }}">{{ $dep['name'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputHiredDate">Hired Date: </label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <input id="inputHiredDate"  placeholder="Date..." name="inputHiredDate" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputEmergencyContact">{{ __('Emergency Contact:') }}</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <input  type="text" class="form-control @error('inputEmergencyContact') is-invalid @enderror" id="inputEmergencyContact" name="inputEmergencyContact" placeholder="Emergency Contact..." required autocomplete="inputEmergencyContact" autofocus>
                                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                        @error('inputEmergencyContact')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputEmergencyPhone">{{ __('Emergency Phone:') }}</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <input  type="text" class="form-control @error('inputEmergencyPhone') is-invalid @enderror" id="inputEmergencyPhone" name="inputEmergencyPhone" data-inputmask="'mask' : '(999) 999-9999'"  placeholder="Emergency Phone..." autocomplete="inputEmergencyPhone">
                                        <span class="fa fa-mobile form-control-feedback right" aria-hidden="true"></span>
                                        @error('inputEmergencyPhone')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="float-right">
                                      <button type="submit" class="btn btn-primary by" ><i class="fa fa-save"></i> Submit</button>
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
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/gijgo.min.js') }}"></script>
    <script src="{{ asset('vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
{{--    <script src="{{ asset('js/supermarket.js') }}"></script>--}}
    <script>
         $( function() {
             $('#inputHiredDate').datepicker({ uiLibrary: 'bootstrap4'});

             $('form').submit(function (){
                 disabledButtonSubmit();
             });
         });
    </script>
@endpush
