@extends('layouts.app')

@section('content')

<div class="container-fluid dashboard">

    
    @if(Auth::user()->onTrial() && Auth::user()->trial_days_left() <= 30)
    <div class="alert {{ Auth::user()->trial_days_left() > 5 ? 'alert-info' : 'alert-warning'}}" role="alert">
        <strong>{{ Auth::user()->trial_days_left() > 5 ? 'Info' : 'Warning' }}</strong> &bull; You are currently in your trial period, which will expire in {{Auth::user()->trial_days_left()}} day(s)
        @if(Auth::user()->trial_days_left() <= 5)
            <a href="{{url('/subscriptions/choose')}}" class="btn btn-sm btn-link"> Upgrade Now</a>
        @endif
    </div>
    @endif

    <div class="row">        
        <div class="col-md-2 col-sm-3 col-xs-4">    
             
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation" class="{{ Request::is('members') ? 'active' : ''}}"><a href="{{ url('/members/') }}"><i class="fa fa-fw fa-newspaper-o" aria-hidden="true"></i> BCOPower News</a></li>
                @if(Auth::user()->admin_verifier)
                <li role="presentation"><a href="{{ url('/members/rates') }}"><i class="fa fa-fw fa-file-text" aria-hidden="true"></i> Shipping Rates</a></li>
                <li role="presentation"><a href="http://schedules.qwyk.io"><i class="fa fa-fw fa-clock-o" aria-hidden="true"></i> Schedules</a></li>
                @endif
                <li role="presentation"><a href="{{ url('/members/forums') }}"><i aria-hidden="true" class="fa fa-fw fa-comments-o"></i> Power Grid</a></li>                
                <li role="presentation" class="{{ Request::is('members/industry-news') ? 'active' : ''}}"><a href="{{ url('/members/industry-news') }}"><i class="fa fa-fw fa-newspaper-o" aria-hidden="true"></i> Industry News</a></li>
                <li role="presentation" class="{{ Request::is('members/stock-quotes') ? 'active' : ''}}"><a href="{{ url('/members/stock-quotes') }}"><i class="fa fa-fw fa-usd" aria-hidden="true"></i> Stock Quotes</a></li>
                <li role="presentation" class="hidden {{ Request::is('members/benchmarking') ? 'active' : ''}}"><a href="{{ url('/members/benchmarking') }}"><i class="fa fa-fw fa-line-chart" aria-hidden="true"></i> Benchmarking</a></li>
                <!-- <li role="presentation"><a href="#"><i class="fa fa-fw fa-calculator" aria-hidden="true"></i> Duties & Taxes</a></li> -->
                <li role="presentation" class="{{ Request::is('members/refer') ? 'active': ''}}"><a href="{{ url('/members/refer') }}"><i class="fa fa-fw fa-retweet" aria-hidden="true"></i> Refer a Colleague</a></li>                
            </ul>
        </div>
        <div class="col-md-8 col-sm-7 col-xs-6">
            @yield('dashboard-content')                       
        </div>
        <div class="col-md-2 col-sm-3 col-xs-4">            
            <!--<div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/DDRFz-1xCOQ?ecver=1"></iframe>
            </div>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/cUcd5_ktdGw?ecver=1"></iframe>
            </div>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/0bCLWeycGMA?ecver=1"></iframe>                
            </div>-->
            
        </div>
    </div>    

</div>


@endsection

