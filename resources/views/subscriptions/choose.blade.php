@extends('layouts.app')

@section('content')

<div class="container">

	<h3>Thank your for signing up {{ Auth::user()->name }}</h3>
	<p>Continue to confirm your subscription</p>

	<div class="row">
		<div class="col-md-4">
			<h5>Gold Membership</h5>
			<ul>
				<li>BCO Power rates, negotiated on your behalf with air- and ocean carriers, and transport providers</li>
				<li>BCO Power Rate System of Ground, Air, and Ocean rates</li>
				<li>Access to the BCO Power HUB and forums</li>
				<li>Monthly industry updates</li>
			</ul>
			<a href="{{ url('subscriptions/create/gold') }}" class="btn btn-primary">Choose Gold!</a>
		</div>
		<div class="col-md-4">
			<h5>Silver Membership</h5>
			<ul>
				<li>BCO Power Rate System of Ground, Air, and Ocean rates</li>
				<li>BCO Power HUB and forums</li>
				<li>Monthly industry updates</li>
			</ul>
			<a href="{{ url('subscriptions/create/silver') }}" class="btn btn-primary">Choose Silver!</a>
		</div>
		<div class="col-md-4">
			<h5>Bronze Membership</h5>
			<ul>
				<li>Access to the BCO Power HUB and forums</li>
				<li>Monthly industry updates</li>
			</ul>
			<a href="{{ url('subscriptions/create/bronze') }}" class="btn btn-primary">Choose Bronze!</a>
		</div>
	</div>

</div>

@endsection