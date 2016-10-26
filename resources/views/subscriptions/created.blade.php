@extends('layouts.app')

@section('content')
	<div class="container">
		<h3>Thank you!</h3>
		<p>Your subscription has been created.</p>
		<a href="{{ url('/members') }}" class="btn btn-primary">Continue to the member area</a>
	</div>
@endsection