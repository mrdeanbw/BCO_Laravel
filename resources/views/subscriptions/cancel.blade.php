@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="col-md-6 col-md-offset-3">
		@if(Auth::user()->subscribed('main'))
			<h3><i class="fa fa-exclamation primary" aria-hidden="true"></i> Cancelling subscription</h3>
			<p class="subtle">This subscription will remain active until the end of the current billing period, we are unable to refund parts of the active month. The current billing period will end at {{ date('d M y', $subscription->current_period_end) }}</p>
			<p>Are you sure you want to cancel your subscription?</p>
			<a href="{{ url('/members') }}" class="btn btn-default">No, take me back</a>
			{{ Form::open(array('url' => 'subscriptions/' . $user->id)) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {!! Form::button("Yes, I'd like to cancel", array('type' => 'submit', 'class' => 'btn btn-danger')) !!}
			{{ Form::close() }}			
		@endif
		
		</div>
	</div>
@endsection