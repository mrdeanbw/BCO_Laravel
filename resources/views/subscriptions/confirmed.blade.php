@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="col-md-6 col-md-offset-3">
		@if(Auth::user()->onTrial() || Auth::user()->onTrial('main'))
			<h3><i class="fa fa-check primary" aria-hidden="true"></i> Trial Subscription confirmed</h3>
			<p>Thank you for subscribing to our trial, you are now all set up to take free advantage of all the benefits your membership offers for 30 days.</p>

			<p class="subtle">At the end of your subscription we will offer your options to convert your trial into a full membership.</p>
		@else

			<h3><i class="fa fa-check primary" aria-hidden="true"></i> Subscription confirmed</h3>
			<p>Thank you for subscribing, you are now all set up to take full advantage of all the benefits your membership offers.</p>

			<p class="subtle">Should you ever wish to switch plans, or cancel your subscription, go to the Subscriptions management in your Profile.</p>
			
		@endif
		<a href="{{ url('/members') }}" class="btn btn-primary">Continue to the members area</a>
		</div>
	</div>
@endsection