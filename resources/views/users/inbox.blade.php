@extends('users.profile')

@section('details')

@foreach($user->notifications as $notification)
	<div class="inbox-item{{$notification->read_at == null ? " unread" : ''}}">
		
		<p class="title"><a href="{{url('/users/inbox/'.$user->id.'/'.$notification->id)}}">{{ $notification->data['subject'] }}</a><span class="pull-right subtle">{{ $notification->created_at }}</span></p>
		<p class="from"><span class="subtle">From:</span> {{ $notification->data['from_name'] }} </p>
		
		
	</div>
@endforeach

@endsection