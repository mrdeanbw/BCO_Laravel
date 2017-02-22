@extends('layouts.app')

@section('content')

<div class="container dashboard">

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
        <div class="col-md-12" style="margin-bottom: -10px">
            <div class="dashboard-block white row">
                <div class="col-md-6">
                    <h3>Shipping Rates</h3>
                    <p>Use our new online app to get your BCO Power negociated FCL, LCL and Parcel rates</p>
                </div>
                <div class="col-md-6">
                    <a href="{{ url('/members/rates') }}" class="btn btn-primary btn-lg btn-sqr">GET STARTED WITH RATES</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">                        
            <stock-app class="dashboard-block primary" symbols="{{Auth::user()->stocksymbols == null ? "EXPD,JBHT,UPS,FDX,CHRW" : Auth::user()->stocksymbols}}"></stock-app>
            <market-news class="dashboard-block secondary" ></market-news>     
        </div>
        <div class="col-md-6">
            <power-grid class="dashboard-block primary"></power-grid>
            <scfi-widget class="dashboard-block white" ></scfi-widget>
            <new-members class="dashboard-block primary" ></new-members>
            <latest-news class="dashboard-block secondary" ></latest-news>
        </div>
    </div>
</div>


@endsection

