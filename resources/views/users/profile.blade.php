@extends('layouts.app')

@section('content')
	<div class="container">
	<h3>My Profile</h3>


	<ul class="nav nav-tabs">
	  <li role="presentation" class="{{ Request::is('users/*/edit') ? 'active' : ''}}"><a href="{{ url('users/'.$user->id.'/edit') }}">Profile</a></li>
	  <li role="presentation" class="{{ Request::is('subscriptions/*/edit') ? 'active' : ''}}"><a href="{{ url('subscriptions/'.$user->id.'/edit') }}">Subscription</a></li>
	  <li role="presentation"><a href="#">Messages</a></li>
	  <li role="presentation"><a href="#">Privacy</a></li>
	</ul>

	@yield('details')
	</div>
@endsection