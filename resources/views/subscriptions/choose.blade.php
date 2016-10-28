@extends('layouts.app')

@section('content')

<div class="container">
	
	<h3><i class="fa fa-shopping-cart primary" aria-hidden="true"></i> Choose a Subscription @if(!isset($subscription))<small class="subtle">(step 2 of 3)</small>@endif</h3>
	@if(!isset($subscription))
		<p>Thank you for signing up, {{ Auth::user()->name }}!<br>To get started, choose a subscription</p>
	
	@else
		<p>Change your BCO Power Plan<br>We'll pro-rate adjust your current invoice based on your change in plan</p>
	@endif
	
</div>


@include('subscriptions.choices')

<div class="spanner spanner-image" style="margin-bottom: -24px;">
    <div class="item" style="background-image: url(/res/s01-1200x534.jpg);">
    </div>
</div>


@endsection