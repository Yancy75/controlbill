@extends('layout.welcome')
@section('content')

    <div class="container">
                <div class="centar_horizontal tituloan" style="font-family: fantasy;"><h1>Welcome to <br>supermarket integrity 1.0</h1></div>
                <div class="cajab">
                     <a href="{{ route('controlBill') }}" type="button" class="btn btn-primary byp"><span><i class="fa fa-files-o"></i></span><span> Control Bills</span></a>
                     <a href="{{ route('payRoll') }}" type="button" class="btn btn-success byp"><i class="fa fa-money"></i> Payroll</a>
               </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/bills.js') }}"></script>
    <script>
        $(function(){
            $("form").on("submit", false);
            $("#storeCode").on("keypress", function (e) {
                if (e.keyCode == 13) {
                    searchStore();
                }
            });
        });
    </script>
@endpush
