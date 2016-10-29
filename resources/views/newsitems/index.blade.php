@extends('layouts.app')

@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		<h3>Association News 
			@can('create', \App\NewsItem::class)
		 		<a href="{{ url('members/news/create') }}" class="btn btn-primary pull-right">Post News Item</a>
		 	@endcan		 
		</h3>

		@foreach($news as $newsitem)
		@can('view', $newsitem)
			<div class="newsitem">
				<h4>
					@can('update', $newsitem)
						<a href="{{url('/members/news/'.$newsitem->id.'/edit') }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
					@endcan
					<a href="{{url('/members/news/'.$newsitem->id)}}">{{ $newsitem->title }}</a>
				</h4>
				<p class="subtle"><small>Posted {{ $newsitem->created_at }} by {{ $newsitem->created_by->name }}</small></p>

				@if(strlen($newsitem->body) > 500)
					<p>{!! substr($newsitem->body, 0, 497) !!}...</p>
					<a href="{{ url('/members/news/'.$newsitem->id) }}">Read more</a>
				@else
					<p>{!! $newsitem->body !!}</p>
				@endif
			</div>
		@endcan
		@endforeach

		{{ $news->links() }}

	</div>
</div>
@endsection
