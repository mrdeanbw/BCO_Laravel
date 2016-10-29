@extends('layouts.app')

@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">

		@if (Session::has('message'))
		<div class="panel-body">
			<div class="alert alert-info">{{ Session::get('message') }}</div>
		</div>
		@endif
		
		<a href="{{ url('/members/news') }}">Return</a>

		<h3>{{ $news->title }}</h3>
		<p>Posted {{ $news->created_at }} by {{ $news->created_by->name }}</p>
		{!! $news->body !!}
	</div>
</div>
@endsection
