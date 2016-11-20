@extends('users.profile')

@section('details')
	<h3>Subscription Details</h3>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

	<h4>{{ $subscription->plan->name }}</h4>
	<p>Created on: {{ date('d/m/y', $subscription->created) }}</p>
	<p>Amount: {{ strtoupper($subscription->plan->currency) }} {{ ($subscription->plan->amount / 100) }} per {{ $subscription->plan->interval }}</p>
	<p>Current period from: {{ date('d/m/y', $subscription->current_period_start) }} to {{ date('d/m/y', $subscription->current_period_end) }}</p>
	
	@if( ! $subscription->cancel_at_period_end)
	<a href="{{url('subscriptions/choose')}}" class="btn btn-primary">Change your Plan</a>
	<a href=""  class="btn btn-link">Cancel your Subscription</a>
	@else
		<div class="alert alert-info" role="alert">This subscription has been cancelled on {{date('d/m/y', $subscription->canceled_at)}} and will expire at the current period end.

		<a href=""  class="btn btn-warning">Reactivate Subscription</a>
		</div>
	@endif


	<h4>Payment Details</h4>
	<p>Card: {{ $user->card_brand }}: &bull;&bull;&bull;&bull;  &bull;&bull;&bull;&bull;  &bull;&bull;&bull;&bull; {{ $user->card_last_four }}</p>
	@if( ! $subscription->cancel_at_period_end)
	<a href=""  class="btn btn-primary">Update your payment details</a>
	@endif
	
	
@endsection
