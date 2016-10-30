@extends('layouts.app')

@section('content')
	<div class="container">
	<div class="col-md-8 col-md-offset-2">
	<h3>My Profile</h3>


	<ul class="nav nav-tabs">
	  <li role="presentation" class="{{ Request::is('users/*/edit') ? 'active' : ''}}"><a href="{{ url('users/'.$user->id.'/edit') }}">Profile</a></li>
	  <li role="presentation" class="{{ Request::is('subscriptions/*/edit') ? 'active' : ''}}"><a href="{{ url('subscriptions/'.$user->id.'/edit') }}">Subscription</a></li>
	  
	  <li role="presentation" class="{{ Request::is('users/inbox/*') ? 'active' : '' }}"><a href="{{ url('users/inbox/'.$user->id) }}">Messages
	  		<?php $noti_count= count(Auth::user()->unreadNotifications);  ?>
            @if($noti_count > 0) 
                <span class="badge">{{ $noti_count }}</span>
            @endif
	  </a></li>
	  
	  <li role="presentation"><a href="#">Privacy</a></li>
	</ul>

	@yield('details')
	</div>
	</div>
@endsection