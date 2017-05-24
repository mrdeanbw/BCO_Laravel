@extends('users.profile')


	@section('css')
	<link rel="stylesheet" type="text/css" href="/summernote/summernote.css">
	@endsection

@section('details')


	<div class="message-detail">
		<a href="{{ url('users/inbox/'.$user->id) }}">Return to Inbox</a>

		<h3>Compose new Message</h3>

		{{ Form::open(array('route'=>'message.send')) }}
			{{ Form::hidden('to_id', $to->id) }}
			{{ Form::submit('Send', array('class' => 'btn btn-primary'))}}
			<a class="btn btn-default" href="{{ url(Request::url()) }}">Reset</a>

			<div class="form-group {{ $errors->has('to') ? ' has-error' : '' }}">
				{{ Form::label('To') }}
				{{ Form::text('name', $to->name . ' at '. $to->organization, array('class' => 'form-control', 'placeholder' => 'To', 'disabled' => 'disabled')) }}
				@if ($errors->has('to'))
				<span class="help-block">
					<strong>{{ $errors->first('to') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group {{ $errors->has('subject') ? ' has-error' : '' }}">
				{{ Form::label('Subject') }}
				{{ Form::text('subject', $input['subject'], array('class' => 'form-control', 'placeholder' => 'Subject')) }}
				@if ($errors->has('subject'))
				<span class="help-block">
					<strong>{{ $errors->first('subject') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
				{{ Form::label('Message') }}
				{!! Form::textarea('body', nl2br(e($input['body'])), array('class' => 'form-control', 'placeholder' => 'Message',  'id' => 'summernote')) !!}
				@if ($errors->has('body'))
				<span class="help-block">
					<strong>{{ $errors->first('body') }}</strong>
				</span>
				@endif
			</div>

			

			
		{{ Form::close() }}
	</div>
@endsection

@section('js')
	<script src="/summernote/summernote.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote({
              height:300,
            });
        });
    </script>
@endsection