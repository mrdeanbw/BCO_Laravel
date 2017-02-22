@extends('users.profile')

@section('details')
	<div class="message-detail">
	<a href="{{ url('users/inbox/'.$user->id) }}">Return to Inbox</a>
	
	<h3>{{ json_decode(strval($notification->data)) }}</h3>
	
	</div>
@endsection