@extends('layouts.app')

@section('content')
<div class="spanner info-page spanner-image">
	<div class="item" style="background-image: url('res/profit-1200x355.jpg');">
		<div class="container">
			<div class="caption">
				<h3>Contact Us</h3>              
			</div>
		</div>
	</div>
</div>


<div class="container info-page">
	<div class="row">
		<div class="col-md-4 col-md-offset-4" style="margin-top: 20px;">
		
			<p style="text-align: center;">
				<strong class="primary">BCO Power has its registered office at</strong><br>
				211 E 43rd Street 6th Floor<br>
				New York, NY 10017<br>
				United States of America<br>
				<i class="fa fa-phone primary" aria-hidden="true"></i> 1-646-694-1190<br>
				<i class="fa fa-at primary" aria-hidden="true"></i> <a href="mailto:membership@bcopower.org">membership@bcopower.org</a><br>
			</p>
		
		</div>
	</div>	
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h3>Send us an enquiry</h3>
			@if (Session::has('message'))
			<div class="panel-body">
				<div class="alert alert-info">{{ Session::get('message') }}</div>
			</div>
			@endif
			{{ Form::open(array('route'=>'contact.store')) }}
			<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
				{{ Form::label('Your name') }}
				{{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Name')) }}
				@if ($errors->has('name'))
				<span class="help-block">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
				{{ Form::label('Email Address') }}
				{{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'Email Address')) }}
				@if ($errors->has('email'))
				<span class="help-block">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group {{ $errors->has('organization') ? ' has-error' : '' }}">
				{{ Form::label('Organization') }}
				{{ Form::text('organization', null, array('class' => 'form-control', 'placeholder' => 'Organization')) }}
				@if ($errors->has('organization'))
				<span class="help-block">
					<strong>{{ $errors->first('organization') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group {{ $errors->has('enquiry') ? ' has-error' : '' }}">
				{{ Form::label('Your enquiry') }}
				{{ Form::textarea('enquiry', null, array('class' => 'form-control', 'placeholder' => 'Enquiry')) }}
				@if ($errors->has('enquiry'))
				<span class="help-block">
					<strong>{{ $errors->first('enquiry') }}</strong>
				</span>
				@endif
			</div>

			{{ Form::submit('Send', array('class' => 'btn btn-primary'))}}
			{{ Form::close() }}
			<br>
		</div>
	</div>
</div>

@endsection