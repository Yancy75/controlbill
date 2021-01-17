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
    </style>
@endsection

@section('content')
    <div class="">
      <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="centar_horizontal">
                          <h3 class="th3">Modify Employee {{$employee['name']}} {{ $employee['last_name'] }}</h3>
                        </div>
                          <div class="row">
                              <div class="col-sm-8 offset-md-2">
                               <div class="x_panel">
                                 <div class="x_title">
                                   <h2><i class="fa fa-user"></i> Modify<small> Employee</small></h2>
                                     <div class="float-right">
                                         @if($view_modify == 'v')
                                            <a href="{{ route('employee_payroll_setting', ['id' => $employee['id'], 'view_modify' => 'v']) }}" class="btn btn-success by"><i class="fa fa-money"></i> Payroll setting</a>
                                         @elseif($view_modify == 'm')
                                            <a href="{{ route('employee_payroll_setting', ['id' => $employee['id'], 'view_modify' => 'm']) }}" class="btn btn-success by"><i class="fa fa-money"></i> Payroll setting</a>
                                         @endif
                                     </div>
                                   <div class="clearfix"></div>
                                 </div>
                                 <div class="x_content">
                            <form method="post" action="{{ route('modifying_employee', ['id' => $employee['id']]) }}" class="form-horizontal form-label-left">
                                @csrf
                                <div class="form-group row">
                                  <label class="control-label col-md-2 col-sm-2" for="inputName">{{ __('Name:') }}</label>
                                  <div class="col-md-10 col-sm-10 ">
                                    <input  type="text" class="form-control @error('inputName') is-invalid @enderror" id="inputName" name="inputName" placeholder="Name..."  value="{{$employee['name']}}" required autocomplete="inputName" autofocus
                                    @if($view_modify == 'v')
                                        disabled
                                    @endif
                                    >
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                    @error('inputName')
                                       <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="control-label col-md-2 col-sm-2" for="inputLastName">{{ __('Last Name:') }}</label>
                                  <div class="col-md-10 col-sm-10 ">
                                    <input  type="text" class="form-control @error('inputLastName') is-invalid @enderror" id="inputLastName" name="inputLastName" value="{{$employee['last_name']}}" placeholder="LastName..." required autocomplete="inputLastName"
                                    @if($view_modify == 'v')
                                        disabled
                                    @endif
                                    >
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                    @error('inputLastName')
                                       <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="control-label col-md-2 col-sm-2" for="inputAddress">{{ __('Address:') }}</label>
                                  <div class="col-md-10 col-sm-10 ">
                                    <input  type="text" class="form-control @error('inputAddress') is-invalid @enderror" id="inputAddress" name="inputAddress" value="{{$employee['address']}}" placeholder="Address..."  autocomplete="inputAddress"
                                    @if($view_modify == 'v')
                                        disabled
                                    @endif
                                    >
                                      <span class="fa fa-location-arrow form-control-feedback right" aria-hidden="true"></span>
                                    @error('inputAddress')
                                       <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="control-label col-md-2 col-sm-2" for="inputCity">{{ __('City:') }}</label>
                                  <div class="col-md-10 col-sm-10 ">
                                    <input  type="text" class="form-control @error('inputCity') is-invalid @enderror" id="inputCity" name="inputCity" value="{{$employee['city']}}" placeholder="CIty..."  autocomplete="inputCity"
                                    @if($view_modify == 'v')
                                        disabled
                                    @endif
                                    >
                                      <span class="fa fa-building-o form-control-feedback right" aria-hidden="true"></span>
                                    @error('inputCity')
                                       <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputState">State:</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <select class="form-control" id="inputState" name="inputState" style="border-radius: 5px;"
                                                @if($view_modify == 'v')
                                                disabled
                                            @endif
                                        >
                                            <option value="{{ $employee['state'] }}">{{ $employee['state'] }}</option>
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
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputZip">{{ __('Zip Code:') }}</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <input  type="text" class="form-control @error('inputZip') is-invalid @enderror" id="inputZip" name="inputZip" value="{{$employee['zip_code']}}" placeholder="Zip Code..."  autocomplete="inputZip"
                                                @if($view_modify == 'v')
                                                disabled
                                            @endif
                                        >
                                        <span class="fa fa-flag form-control-feedback right" aria-hidden="true"></span>
                                        @error('inputZip')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                  <label class="control-label col-md-2 col-sm-2" for="inputMobil">{{ __('Mobil:') }}</label>
                                  <div class="col-md-10 col-sm-10 ">
                                    <input  type="text" class="form-control @error('inputMobil') is-invalid @enderror" id="inputMobil" name="inputMobil" data-inputmask="'mask' : '(999) 999-9999'"  value="{{$employee['mobil']}}" placeholder="Mobil..."  autocomplete="inputMobil"
                                    @if($view_modify == 'v')
                                        disabled
                                    @endif
                                    >
                                      <span class="fa fa-mobile form-control-feedback right" aria-hidden="true"></span>
                                    @error('inputMobil')
                                       <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputEmail">{{ __('Email:') }}</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <input  type="text" class="form-control @error('inputEmail') is-invalid @enderror" id="inputEmail" name="inputEmail" value="{{$employee['email']}}" placeholder="Email..."  autocomplete="inputEmail"
                                                @if($view_modify == 'v')
                                                disabled
                                            @endif
                                        >
                                        <span class="fa fa-mobile form-control-feedback right" aria-hidden="true"></span>
                                        @error('inputMobil')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputGender">{{ __('Gender:') }}</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <select class="form-control" id="inputGender" name="inputGender" style="border-radius: 5px;"
                                                @if($view_modify == 'v')
                                                disabled
                                            @endif
                                        >
                                            <option value="{{ $employee['gender'] }}">{{ ucwords($employee['gender']) }}</option>
                                            @if($employee['gender'] == 'male')
                                                <option value="female">Female</option>
                                            @elseif($employee['gender'] == 'female')
                                                <option value="male">Male</option>
                                            @else
                                                <option value="female">Female</option>
                                                <option value="male">Male</option>
                                            @endif

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputDepartment">Department:</label>
                                      <div class="col-md-10 col-sm-10 ">
                                    <select class="form-control" id="inputDepartment" name="inputDepartment" style="border-radius: 5px;"
                                    @if($view_modify == 'v')
                                        disabled
                                    @endif
                                    >
                                        <option value="{{ $employee['department_id'] }}">{{ $dep_usuario }}</option>
                                        @if(!empty($department))
                                            @foreach($department as $dep)
                                                @if($dep['id'] != $employee['department_id'])
                                                <option value="{{ $dep['id'] }}">{{ $dep['name'] }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                    </select>
                                  </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputHiredDate">Hired Date: </label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <input id="inputHiredDate" class="form-control @error('inputHiredDate') is-invalid @enderror"  placeholder="Date..." name="inputHiredDate" autocomplete="off" value="{{$employee['inicial_date']}}"
                                           @if($view_modify == 'v')
                                               disabled
                                           @endif
                                        />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputEmergencyContact">{{ __('Emergency Contact:') }}</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <input  type="text" class="form-control @error('inputEmergencyContact') is-invalid @enderror" id="inputEmergencyContact" name="inputEmergencyContact" placeholder="Emergency Contact..."  value="{{$employee['emergency_contact']}}" required autocomplete="inputEmergencyContact" autofocus
                                                @if($view_modify == 'v')
                                                disabled
                                            @endif
                                        >
                                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                        @error('inputEmergencyContact')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2" for="inputEmergencyPhone">{{ __('Emergency Phone:') }}</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <input  type="text" class="form-control @error('inputEmergencyPhone') is-invalid @enderror" id="inputEmergencyPhone" name="inputEmergencyPhone" placeholder="Emergency Phone..." data-inputmask="'mask' : '(999) 999-9999'"  value="{{$employee['emergency_phone']}}" required autocomplete="inputEmergencyPhone" autofocus
                                                @if($view_modify == 'v')
                                                disabled
                                            @endif
                                        >
                                        <span class="fa fa-mobile form-control-feedback right" aria-hidden="true"></span>
                                        @error('inputEmergencyPhone')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div id="titulo_terminated_employee" class="ocultar" style=" text-align: center;">

                                    <h3>Terminated Employee</h3>
                                    <hr/>

                                </div>

                                <div class="form-group row">
                                    <input id="status_employee_id" type="hidden" value="{{ $employee['status'] }}">
                                    <label  class="control-label col-md-2 col-sm-2" for="inputStatus">Status:</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <select class="form-control" id="inputStatus" name="inputStatus" style="border-radius: 5px;" disabled>
                                          @if($employee['status'] == 'active')
                                              <option value="active">Active</option>
                                              <option value="inactive">Inactive</option>
                                          @else
                                              <option value="inactive">Inactive</option>
                                              <option value="active">Active</option>
                                          @endif
                                        </select>
                                    </div>
                                </div>

                                @if($view_modify == 'm')
                                    <div>
                                        <button id="mostrarEndDateId" type="button" class="btn btn-warning by" onclick="mostrarEndDate();">Termination Employee</button>
                                    </div>
                                @endif

                                <div id="endDateId" class="form-group row ocultar">
                                    <label class="control-label col-md-2 col-sm-2" for="inputFiredDate">End Date: </label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <input id="inputFiredDate" class="form-control @error('inputHiredDate') is-invalid @enderror"  placeholder="Date..." name="inputFiredDate" autocomplete="off" value="{{$employee['end_date']}}"
                                            @if($view_modify == 'v')
                                               disabled
                                            @endif
                                        />
                                    </div>
                                </div>

                                <div id="authorizedById" class="form-group row ocultar">
                                    <label class="control-label col-md-2 col-sm-2" for="inputauthorizedBy">Authorized By: </label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <select class="form-control" id="inputauthorizedBy" name="inputauthorizedBy" style="border-radius: 5px;">

                                            @if($employee['authorized_by'] == 'juan perez')
                                                <option value="juan perez">Juan Perez</option>
                                                <option value="pedro goico">Pedro Goico</option>
                                            @else
                                                <option value="pedro goico">Pedro Goico</option>
                                                <option value="juan perez">Juan Perez</option>
                                            @endif
                                        </select>
                                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div id="reasonEndDateId" class="form-group row ocultar">
                                    <label class="control-label col-md-2 col-sm-2" for="inputReasonFiredDate">Reason: </label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <input id="inputReasonFiredDate" class="form-control @error('inputHiredDate') is-invalid @enderror" placeholder="Reason..." name="inputReasonFiredDate" autocomplete="off" value="{{$employee['reason']}}"
                                               @if($view_modify == 'v')
                                               disabled
                                            @endif
                                        />
                                        <span class="fa fa-sticky-note form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div id="detailId" class="form-group row ocultar">
                                    <label class="control-label col-md-2 col-sm-2" for="inputDetail">Detail: </label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <input id="inputDetail" class="form-control @error('inputHiredDate') is-invalid @enderror"  placeholder="Detail..." name="inputDetail" autocomplete="off" value="{{$employee['detail']}}"
                                            @if($view_modify == 'v')
                                               disabled
                                            @endif
                                        />
                                        <span class="fa fa-sticky-note form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                </div>
                                @php
                                    $error = false;
                                    $mensaje = '';
                                    if(array_key_exists('error', session()->all()))
                                    {
                                        $error   = session()->all()['error'];
                                        if(!empty($error->get('inputReasonFiredDate')))
                                        {
                                            echo '<span style="color:red;"><strong>'.$error->get('inputReasonFiredDate')[0].'</strong></span>';
                                        }
                                        elseif (!empty($error->get('inputFiredDate')))
                                        {
                                            echo '<span style="color:red;"><strong>'.$error->get('inputFiredDate')[0].'</strong></span>';
                                        }
                                    }
                                @endphp

{{--                                Rehide--}}
                                <div id="authorizedRehideById" class="ocultar">
                                    <div style=" text-align: center;">
                                        <h3>Rehided Employee</h3>
                                        <hr/>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-md-2 col-sm-2" for="inputauthorizedRehideBy">Authorized By: </label>
                                        <div class="col-md-10 col-sm-10 ">
                                            <select class="form-control" id="inputauthorizedRehideBy" name="inputauthorizedRehideBy" style="border-radius: 5px;" disabled>

                                                @if($employee['authorized_rehide_by'] == 'juan perez')
                                                    <option value="juan perez">Juan Perez</option>
                                                    <option value="pedro goico">Pedro Goico</option>
                                                @else
                                                    <option value="pedro goico">Pedro Goico</option>
                                                    <option value="juan perez">Juan Perez</option>
                                                @endif
                                            </select>
                                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-md-2 col-sm-2" for="inputReHiredDate">Rehired Date: </label>
                                        <div class="col-md-10 col-sm-10 ">
                                            <input id="inputReHiredDate" class="form-control @error('inputReHiredDate') is-invalid @enderror"  placeholder="Date..." name="inputReHiredDate" autocomplete="off" value="{{$employee['rehide_date']}}" disabled/>
                                        </div>
                                    </div>
                                </div>

{{--                                Rehide--}}
                                <hr>
                                <div class="float-right">
                                    @if($view_modify == 'm')
                                        <a href="{{ route('employees_list', ['id_supermarket' => $employee['supermarket_id']]) }}" class="btn btn-danger by"><i class="fa fa-close"></i> Cancel</a>
                                        <button type="submit" class="btn btn-primary by"><i class="fa fa-edit"></i> Save</button>
                                    @elseif($view_modify == 'v')
                                        <a href="{{ route('employees_list', ['id_supermarket' => $employee['supermarket_id']]) }}" class="btn btn-secondary by"><i class="fa fa-arrow-left"></i> Back</a>
                                    @endif
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


        <div class="row">
            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-8 offset-md-2">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2><i class="fa fa-user"></i> History<small> Employee</small></h2>
                                        <div class="float-right">
                                            @if($employee['status'] == 'inactive' && $view_modify == 'm')
                                                <button class="btn btn-success by" onclick="mostrarRehideBy();"><i class="fa fa-user"></i> Rehire</button>
                                            @endif
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        @foreach($historico as $his)
                                            <div class="card" style="width: 99%;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><ins>{{ $his->name }}</ins> <span class="float-right">{{$his->date}}</span></h5>
                                                    <p class="card-text">{{$his->accion}}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
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
    <script src="{{ asset('js/gijgo.min.js') }}"></script>
    <script src="{{ asset('vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('js/employee.js') }}"></script>
    <script>
        $( function() {
            $('#inputHiredDate').datepicker({ uiLibrary: 'bootstrap4'});
            $('#inputFiredDate').datepicker({ uiLibrary: 'bootstrap4'});
            $('#inputReHiredDate').datepicker({ uiLibrary: 'bootstrap4'});

            if($("#inputFiredDate").val().length > 0)
            {
                $("#endDateId").removeClass('ocultar');
                $("#reasonEndDateId").removeClass('ocultar');
                $("#detailId").removeClass('ocultar');
                $("#authorizedById").removeClass('ocultar');

                $("#inputFiredDate").prop( "disabled", true );
                $("#inputauthorizedBy").prop( "disabled", true );
                $("#inputReasonFiredDate").prop( "disabled", true );
                $("#inputDetail").prop( "disabled", true );
            }

            if( $("#status_employee_id").val() == 'inactive')
            {
                $("#mostrarEndDateId").addClass('ocultar');
            }

            if($('#inputReHiredDate').val().length > 0)
            {
                $("#authorizedRehideById").removeClass('ocultar');
            }

        });


    </script>
@endpush
