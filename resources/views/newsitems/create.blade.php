@extends('layouts.app')


@section('css')
	<link rel="stylesheet" type="text/css" href="/summernote/summernote.css">
@endsection

@section('content')

<div class="container">
	<div class="col-md-8 col-md-offset-2">

	{{ Html::ul($errors->all()) }}

	{{ Form::open(array('url'=>'members/news')) }}
		<div class="form-group">
			{{ Form::submit('Post', array('class' => 'btn btn-primary')) }}
			<a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a>
		</div>

		<div class="form-group">			
			{{ Form::text('title', null, array('class'=>'form-control form-control-lg', 'placeholder'=>'News Item Title')) }}
		</div>

		<div class="form-group">
		 	<label>
		 	{{ Form::checkbox('pinned', '1', null) }}
		 	<i class="fa fa-thumb-tack" aria-hidden="true"></i> Pin
			
			</label>
		</div>

		<div class="form-group">
		 	<label>
		 	{{ Form::checkbox('notify', '1', null) }}
		 	<i class="fa fa-share" aria-hidden="true"></i> Notify Members			
			</label>
		</div>

		<div class="form-group">
		 {{Form::label('body', 'Content')}}
		 {{Form::textarea('body',null,array('class' => 'form-control', 'placeholder'=>'Content', 'id' => 'summernote'))}}
		</div>


	{{ Form::close() }}

	</div>
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