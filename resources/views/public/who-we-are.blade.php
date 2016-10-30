@extends('layouts.app')

@section('content')
<div class="spanner info-page spanner-image">
	<div class="item" style="background-image: url('res/a-bg-1200x381.jpg');">
		<div class="container">
			<div class="caption">
				<h3>Who We Are</h3>              
			</div>
		</div>
	</div>
</div>


<div class="container info-page">
	<div class="row">
		<div class='col-md-12'>
		<h3>BCO POWER</h3>

			
			<p>BCO Shippers Association is a non-profit 501(c)3 organization that provides buying power in transportation services and technology offerings through its membership portal, BCO POWER.</p>
			<p>BCO Shippers Association (BCO) offers membership to importers and exporters of various products through volume buying power of transportation services such as parcel, less than truckload, drayage, air, and ocean. The members also receive technology benefits through the membership portal.
			</p>
		</div>
	</div>

	<div class="action-box">		
		<h3>To apply for a membership today.</h3>		
		<a href="{{ url('/register') }}" class="btn btn-default">Register Here</a>
	</div>

</div>



@endsection