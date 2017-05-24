@extends('users.profile')

@section('details')
	<div class="message-detail">
	<a href="{{ url('users/inbox/'.$user->id) }}">Return to Inbox</a>

	<div>
	<h3>{{ $data->subject }}</h3>
	<p><strong>{{ $data->from_name}}</strong><br />{{ $notification->created_at->diffForHumans() }}</p>

	@if($notification->type == 'App\Notifications\News')
	<h4><a href="{{ url($data->url) }}">Read The Full News Item</a></h4>
	@endif

	@if($notification->type == 'App\Notifications\MemberMessage')
	<h4><a href="{{ url($data->url.'?reply='.$reply) }}">Reply</a></h4>
	@endif

	<div style="border: 1px solid lightgray; border-left: none; border-right: none; padding: 12px 0; max-height: 200px overflow-y: scroll;">
		<p>{!! $data->body !!}</p>
	</div>

	@if($notification->type == 'App\Notifications\News')
	<h4><a href="{{ url($data->url) }}">Read The Full News Item</a></h4>
	@endif

	</div>

<!--	<code>{{ json_encode($data) }}</code>
	<code>{{ json_encode($notification) }}</code>-->
	
	</div>
@endsection