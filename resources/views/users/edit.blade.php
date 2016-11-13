@extends('users.profile')

@section('details')
	<div class="col-md-6 col-md-offset-3">
	<h4>Update your password</h4>
	{{ Form::model($user, ['url' => ['users/update_pwd', $user->id], 'method' => 'PUT']) }}
		<div class="form-group">

			{{ Form::label('password_old', 'Old Password') }}
			{{ Form::password('password_old', array('class'=>'form-control')) }}			
		</div>
		<div class="form-group">
			{{ Form::label('password', 'New Password') }}
			{{ Form::password('password', array('class'=>'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('password_confirm', 'Confirm New Password') }}
			{{ Form::password('password_confirm', array('class'=>'form-control')) }}
		</div>
			{{ Form::submit('Update my Password', array('class' => 'btn btn-primary')) }}
		
	{{ Form::close() }}
	</div>
@endsection


@section('js')
<script src="/js/pwstrength-bootstrap.min.js" type="text/javascript"></script>
<script>
      $('#password').pwstrength({ui: { showVerdictsInsideProgressBar: true, progressBarEmptyPercentage: 0}, common: {minChar: 6}});
</script>
@endsection