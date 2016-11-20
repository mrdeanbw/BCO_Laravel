@extends('users.profile')

@section('details')

@if (Session::has('message'))
<div class="panel-body">
	<div class="alert alert-info">{{ Session::get('message') }}</div>
</div>
@endif

{{ Form::model($user->privacy_settings, ['route' => ['privacy.update', $user->id], 'method' => 'PUT']) }}

<table class="table">
	<thead>

	</thead>
	<tbody>
		<tr>
			<td rowspan="2">
				<strong>Notifications</strong>
			</td>
			<td>News</td>
			<td><label>{{ Form::checkbox('news_email', '1', null) }} Email</label></td>
			<td><label>{{ Form::checkbox('news_dm', '1', null) }} Direct Message</label></td>
		</tr>
		<tr>
			<td>New Message</td>
			<td><label>{{ Form::checkbox('message_email', '1', null) }} Email</label></td>
			<td></td>
		</tr>
		
		<tr>
			<td rowspan="2">
				<strong>Directory</strong>
			</td>
			<td>Show me in the directory</td>
			<td colspan="2"><label>{{ Form::checkbox('directory_show', '1', null) }} Show</label></td>
		</tr>
		<tr>
			<td>Allow other members to send me messages</td>
			<td colspan="2"><label>{{ Form::checkbox('member_message_allow', '1', null) }} Allow</label></td>
		</tr>
	</tbody>

</table>

{{ Form::submit('Save', array('class' => 'btn btn-primary'))}}
<a href="{{ url('/users/privacy/'.$user->id) }}" class="btn btn-default">Cancel</a>

{{ Form::close() }}


@endsection

