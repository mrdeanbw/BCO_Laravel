@extends('layouts.app')

@section('content')

<div class="container">
	
	<h3><i class="fa fa-shopping-cart primary" aria-hidden="true"></i> Choose a Subscription</h3>
	@if(!Auth::guest())
		@if(!isset($subscription))
			<p>Your free trial has ended {{ Auth::user()->name }}! To continue enjoying BCO Power's benefits, choose a subscription</p>		
		@else
			<p>Change your BCO Power Plan<br>We'll pro-rate adjust your current invoice based on your change in plan</p>
		@endif
	@endif
</div>


@include('subscriptions.choices')

<div class="spanner spanner-image" style="margin-bottom: -24px;">
    <div class="item" style="background-image: url(/res/s01-1200x534.jpg);">
    </div>
</div>


@endsection