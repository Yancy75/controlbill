@extends('layout.payroll_app')

@section('style')
<style>
.tile-stats{max-width: 300px;min-width: 240px;background: #8b946b;background-image: linear-gradient(to bottom right, white,#8b946b , #d0db8e); border: 3px solid gold;}
.tile1{display: flex; flex-direction: row;  color: white; text-shadow: 1px 1px 3px black; font-family: cocina; font-size: 1.1em;}
.tile2{padding-left: 5px; background: rgb(0 0 0 / 0.2);}
.marco{ margin-left: 10px;margin-right: 10px;}
.mote{border-top: 2px solid;font-weight: 700; color: gold !important; text-shadow: 1px 1px 3px black; margin: 0; padding-bottom: 5px; border-top: 2px solid;}
.tooltip-inner {font-weight: 700; text-align: justify;}
.count{text-align: left; font-size: 2em;    text-overflow: ellipsis;  overflow: hidden;}
.fa-shopping-cart{color:gold; font-size: 50px; margin-right: 12px;}
</style>
@endsection

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body" style="text-align: center;">
                      <h2  class="th2"><span class="th3ex"><i class="fa fa-dashboard"></i> Dashboard</span></h2>
                        @if(empty($info))
                            <h4 class="th3">There is no supermaket roll with this user</h4>
                        @else
                            @if(session()->get('supermarket_id') >= 1)
                                @foreach($info as $in)
                                    @if($in['supermarket_id'] == session()->get('supermarket_id'))
                                        <h5 class="tituloide">{{ $in['name'] }} has been Selected</h5>
                                    @endif
                                @endforeach
                            @else
                                <h5 class="th3">Select one of the supermarket to start work</h5>
                            @endif
                            <div class="row" style="justify-content: center;">
                                @foreach($info as $inf)
                                    <div class="animated flipInY marco " data-toggle="tooltip" data-placement="bottom" title="{{ $inf['name'] }}">
                                        <a href="{{ route('select_supermarket', ['id' => $inf['id']]) }}" >
                                            <div class="tile-stats by">
                                              <div class="tile1">
                                                <div class="count">{{ $inf['name'] }}</div>
                                                <div class="tile2"><i class="fa fa-shopping-cart"></i></div>
                                              </div>
                                                <h3 class="mote">Supermarket</h3>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
