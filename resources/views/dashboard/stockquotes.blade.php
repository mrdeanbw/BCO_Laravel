@extends('dashboard')
@section('dashboard-content')

     <stock-app class="dashboard-block" symbols="{{Auth::user()->stocksymbols == null ? "EXPD,JBHT,UPS,FDX,CHRW" : Auth::user()->stocksymbols}}"></stock-app>

@endsection