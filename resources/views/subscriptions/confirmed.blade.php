@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="col-md-6 col-md-offset-3">
		@if(Auth::user()->onTrial() || Auth::user()->onTrial('main'))
			<h3><i class="fa fa-check primary" aria-hidden="true"></i> Thank you for subscribing!</h3>
			<p>To show you our thanks, we've given you a <strong>free 30 day trial</strong> of our Premiere Membership plan.</p>

			<p class="subtle">At the end of your trial period we will offer you options to convert your trial into a full membership using a plan of your choice.</p>
		@else

			<h3><i class="fa fa-check primary" aria-hidden="true"></i> Subscription confirmed</h3>
			<p>Thank you for subscribing, you are now all set up to take full advantage of all the benefits your membership offers.</p>

			<p class="subtle">Should you ever wish to switch plans, or cancel your subscription, go to the Subscriptions management in your Profile.</p>
			
		@endif
		<a href="{{ url('/members') }}" class="btn btn-primary">Continue to the members area <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
		</div>
	</div>
@endsection