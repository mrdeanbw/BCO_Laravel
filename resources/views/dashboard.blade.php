@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Member Information Hub</h2>
    @if(Auth::user()->onTrial('main') || Auth::user()->onTrial())
    <div class="alert alert-info" role="alert"><strong>Info</strong>   &bull;   
    You are currently in your trial period, 
        @if(Auth::user()->onTrial('main'))
            check your subscription information <a href="{{ url('subscriptions/'.Auth::user()->id.'/edit') }}">here</a>
        @else
            which will expire {{Auth::user()->trial_ends_at}}
        @endif
    </div>
    @endif
    <div class="row">
        <div class="col-md-4">            
            <stock-app symbols="'EXPD', 'JBHT', 'UPS', 'FDX', 'CHRW'"></stock-app>
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

