@extends('layouts.app')

@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">

		@if (Session::has('message'))
		<div class="panel-body">
			<div class="alert alert-info">{{ Session::get('message') }}</div>
		</div>
		@endif
		<h3><i class="fa fa-newspaper-o primary" aria-hidden="true"></i> Association News 
			@can('create', \App\NewsItem::class)
		 		<a href="{{ url('members/news/create') }}" class="btn btn-primary pull-right">Post News Item</a>
		 	@endcan		 
		</h3>
		<br>
		@foreach($news as $newsitem)
			@can('view', $newsitem)
				<div class="newsitem">
					
					<h4>						
						@if($newsitem->pinned)
						<i class="fa fa-thumb-tack primary" aria-hidden="true"></i>
						@endif
						<strong><a href="{{url('/members/news/'.$newsitem->id)}}">{{ $newsitem->title }}</a></strong>
						<span class="pull-right">
						@can('update', $newsitem)
							<a href="{{url('/members/news/'.$newsitem->id.'/edit') }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
						@endcan
						@can('delete', $newsitem) 
							{{ Form::open(array('url' => 'members/news/' . $newsitem->id, 'class' => 'pull-right')) }}
			                    {{ Form::hidden('_method', 'DELETE') }}
			                    {!! Form::button('<i class="fa fa-remove" aria-hidden="true"></i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs')) !!}
			                {{ Form::close() }}							
						@endcan
						</span>
					</h4>
					<p class="subtle"><small>Posted {{ $newsitem->created_at }} by {{ $newsitem->created_by->name }}</small></p>
					<div class="newsitem-content">
						<p>{!! $newsitem->summary !!}</p>
						<a href="{{ url('/members/news/'.$newsitem->id) }}" class="readmore"><i class="fa fa-caret-down" aria-hidden="true"></i> Read more</a>
					</div>

				</div>
			@endcan
		@endforeach

		{{ $news->links() }}

	</div>
</div>
@endsection
