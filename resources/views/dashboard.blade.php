@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Member Information Hub</h2>
    @if(Auth::user()->onTrial())
    <div class="alert {{ Auth::user()->trial_days_left() > 5 ? 'alert-info' : 'alert-warning'}}" role="alert">
        <strong>{{ Auth::user()->trial_days_left() > 5 ? 'Info' : 'Warning' }}</strong> &bull; You are currently in your trial period, which will expire in {{Auth::user()->trial_days_left()}} day(s)
        @if(Auth::user()->trial_days_left() <= 5)
            <a href="{{url('/subscriptions/choose')}}" class="btn btn-sm btn-link"> Upgrade Now</a>
        @endif
    </div>
    @endif
    <div class="row">
        <div class="col-md-4">                        
            <stock-app symbols="{{Auth::user()->stocksymbols == null ? "'EXPD', 'JBHT', 'UPS', 'FDX', 'CHRW'" : Auth::user()->stocksymbols}}"></stock-app>
            <market-news></market-news>     
        </div>
        <div class="col-md-8">
            <scfi-widget></scfi-widget>
            <latest-news></latest-news>
            <new-members></new-members>
        </div>
    </div>
</div>


@endsection

