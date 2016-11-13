@extends('layouts.app')

@section('content')
<div class="spanner info-page spanner-image">
	<div class="item" style="background-image: url('res/profit-1200x355.jpg');">
		<div class="container">
			<div class="caption">
				<h3>Shipping Rates</h3>              
			</div>
		</div>
	</div>
</div>


<div class="container info-page">
	<div class="row">
		<div class='col-md-12'>
			<h4>Rate Pooling</h4>
			<p>BCO Power provides more competitive shipping rates as your company is pooled together of other shippers to give everyone an advantage in procuring rates from different vendors. BCO Power provides rates for the following modes:</p>
			<ul>
				<li>Air</li>
				<li>Ground LTL / Haulage</li>
				<li>Ocean FCL</li>
				<li>Ocean LCL</li>
				<li>Parcel</li>
			</ul>
		</div>
	</div>
	<div class="action-box">
		<h2>Convinced?<h2>
			<h3>Choose one of our plans below.</h3>
			<p>Or feel free to contact us if you have any questions</p>
			<a href="{{ url('/contact') }}" class="btn btn-default">Contact</a>
		</div>

	</div>
	@include('subscriptions.choices')


	<div class="spanner spanner-image" style="margin-bottom: -24px;">
		<div class="item" style="background-image: url('res/banner1-1200x376.jpg');">
		</div>
	</div>

	@endsection