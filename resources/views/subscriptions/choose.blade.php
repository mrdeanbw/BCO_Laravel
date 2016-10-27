@extends('layouts.app')

@section('content')

<div class="container">

	@if(!isset($subscription))
	<h3>Thank your for signing up {{ Auth::user()->name }}</h3>
	<p>Continue to confirm your subscription</p>
	@else
	<h3>Modify your plan here</h3>
	<p>We'll pro-rate adjust your current invoice based on your change in plan</p>
	@endif


	<div class="row">
		<div class="col-md-4">
			<h5>Gold Membership</h5>
			<ul>
				<li>BCO Power rates, negotiated on your behalf with air- and ocean carriers, and transport providers</li>
				<li>BCO Power Rate System of Ground, Air, and Ocean rates</li>
				<li>Access to the BCO Power HUB and forums</li>
				<li>Monthly industry updates</li>
			</ul>

			@if(!isset($subscription) or $subscription->stripe_plan != 'bcopower-gold')
				@if(!isset($subscription)) 
					<a href="{{ url('subscriptions/create/gold') }}" class="btn btn-primary">Choose Gold!</a>
				@else
					{!! Form::model($subscription, ['route' => ['subscriptions.update', Auth::user()->id], 'method' => 'PUT']) !!}
						{{ Form::submit('Choose Gold!', array('class' => 'btn btn-primary')) }}
						{{ Form::hidden('plan_id', 'bcopower-gold', array('id' => 'plan_id')) }}
					{!! Form::close() !!}
				@endif
			@else
				<a href="" disabled class="btn btn-default">Your Current Plan</a>
			@endif
		</div>
		<div class="col-md-4">
			<h5>Silver Membership</h5>
			<ul>
				<li>BCO Power Rate System of Ground, Air, and Ocean rates</li>
				<li>BCO Power HUB and forums</li>
				<li>Monthly industry updates</li>
			</ul>
			@if(!isset($subscription) or $subscription->stripe_plan != 'bcopower-silver')
				
				@if(!isset($subscription)) 
					<a href="{{ url('subscriptions/create/silver') }}" class="btn btn-primary">Choose Silver!</a>
				@else
					{!! Form::model($subscription, ['route' => ['subscriptions.update', Auth::user()->id], 'method' => 'PUT']) !!}
						{{ Form::submit('Choose Silver!', array('class' => 'btn btn-primary')) }}
						{{ Form::hidden('plan_id', 'bcopower-silver', array('id' => 'plan_id')) }}
					{!! Form::close() !!}
				@endif
			@else
				<a href="" disabled class="btn btn-default">Your Current Plan</a>
			@endif
		</div>
		<div class="col-md-4">
			<h5>Bronze Membership</h5>
			<ul>
				<li>Access to the BCO Power HUB and forums</li>
				<li>Monthly industry updates</li>
			</ul>
			@if(!isset($subscription) or $subscription->stripe_plan != 'bcopower-bronze')
				
				@if(!isset($subscription)) 
					<a href="{{ url('subscriptions/create/bronze') }}" class="btn btn-primary">Choose Bronze!</a>
				@else
					{!! Form::model($subscription, ['route' => ['subscriptions.update', Auth::user()->id], 'method' => 'PUT']) !!}
						{{ Form::submit('Choose Bronze!', array('class' => 'btn btn-primary')) }}
						{{ Form::hidden('plan_id', 'bcopower-bronze', array('id' => 'plan_id')) }}
					{!! Form::close() !!}
				@endif
			@else
				<a href="" disabled class="btn btn-default">Your Current Plan</a>
			@endif
		</div>
	</div>

</div>

@endsection