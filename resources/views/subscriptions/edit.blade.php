@extends('users.profile')

@section('details')
	<h3>Subscription Details</h3>

	<h2>{{ $subscription->plan->name }}</h2>
	<p>Created on: {{ date('d/m/y', $subscription->created) }}</p>
	<p>Amount: {{ strtoupper($subscription->plan->currency) }} {{ ($subscription->plan->amount / 100) }} per {{ $subscription->plan->interval }}</p>
	<p>Current period from: {{ date('d/m/y', $subscription->current_period_start) }} to {{ date('d/m/y', $subscription->current_period_end) }}</p>
	
	@if($subscription->cancel_at_period_end)
		<p>This subscription has been cancelled on {{date('d/m/y', $subscription->canceled_at)}} and will expire at the current period end.</p>
	@endif


	<h2>Payment Details</h2>
	<p>Card: {{ $user->card_brand }}: &bull;&bull;&bull;&bull;  &bull;&bull;&bull;&bull;  &bull;&bull;&bull;&bull; {{ $user->card_last_four }}</p>

<br><br><br>
	
	<p>{{ $subscription }}</p>
	<p>{{ $user }}
@endsection
