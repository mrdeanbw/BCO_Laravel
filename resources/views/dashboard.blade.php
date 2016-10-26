@extends('layouts.app')

@section('content')

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js" type="text/javascript"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-route.js" type="text/javascript" ></script>


<div class="container">

    <h2>Member Information Hub</h2>
    <div class="alert alert-warning" role="alert"><strong>Warning</strong>   &bull;   Your BCO Power membership is expiring <a href="#">Extend Now</a></div>
    <div class="row">
        <div class="col-md-4">            
            <h3>Markets</h3>
            @include('widgets.stockquote')

        </div>
        <div class="col-md-8">
            <h3>Association News</h3>
        </div>
    </div>

    <div class="row">
	    <div class="col-md-4">
        <h3>Industry News</h3>
	    	@include('widgets.news')
	    </div>
	    <div class="col-md-8">
	    </div>
    </div>
</div>


@endsection

