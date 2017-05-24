@extends('layouts.app')

@section('content')
<div class="container directory">
	<h3><i class="fa fa-compass primary" aria-hidden="true"></i> Member Directory</h3>
	<div class="col-md-12">

		@if (Session::has('message'))
		<div class="panel-body">
			<div class="alert alert-info">{{ Session::get('message') }}</div>
		</div>
		@endif
		{{ Form::open(array('method' => 'GET', 'url'=>'members/directory', 'class' => 'form-inline directory-search')) }}
		<div class="form-group">			
		    <label for="search_name"> Search the Directory&nbsp;</label>		    
		    {{ Form::text('org', Request::get('org'), array('class'=>'form-control', 'placeholder'=>'Organization')) }}
		  </div>
		  <div class="form-group">		    
		    {{ Form::text('name', Request::get('name'), array('class'=>'form-control', 'placeholder'=>'Name')) }}
		  </div>
		  <button type="submit" class="btn btn-primary">Search</button>
		  <a href="{{  url('members/directory?nearby=1') }}" class="btn btn-primary">Show Members Near Me</a>
		{{ Form::close() }}
		
	</div>
	<div class="col-md-12">
		{{ $members->links() }}		
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					
					
					<th>
						Organization
					</th>
					<th>
						Location
					</th>
					@if($range > -1)
					<th>
					</th>
					@endif
					<th>
						Name
					</th>
					<th>
						
					</th>
					<th>
						
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach($members as $member)
				@if($range == -1 || $member->distance <= $range)
				<tr>
					
					<td>
						{{ $member->organization }}
					</td>
					<td>
						{{ $member->city }}, {{ $member->state }}, {{ $member->country }}
					</td>
					@if($range > -1)
					<td>
						@if($member->distance < 10 && $member->distance > 0)
						Less than 
						@else 
						About 
						@endif
						{{ ceil($member->distance / 10) * 10 }} miles
					</td>
					@endif
					<td>
						{{ $member->name }}
					</td>
					<td>
						{{ $member->industry_type }}
					</td>
					<td>
						@if($member->privacy_settings->member_message_allow)
						<a href="{{ url('/users/compose/'.\Auth::user()->id.'/'.$member->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-envelope" aria-hidden="true"></i></a>
						@endif
						
					</td>
				</tr>
				@endif
				@endforeach
			</tbody>
		</table>
		{{ $members->links() }}		

	</div>
</div>
@endsection
