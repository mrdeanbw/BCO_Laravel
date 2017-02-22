@extends('layouts.app')

@section('content')

<div class="container info-page">
	<div class="row">
	<div class='col-md-12'>
	<h3>BCO Shippers Association is the fastest growing non-profit that strictly focuses on BUYING POWER for its members. Here are benefits to joining BCO Shippers Association:</h3>
	
		<h4>BEST OF BREED TECHNOLOGY</h4>
		<p>It's software component, BPO Power, enables shippers access to ocean/air/ground freight rates, index charts, tech tools, as well as discounts on whitepapers, reports, and other information that will help you make better decisions. Its "Ask BCO" portal provides a collaboration between members that anyone can ask a question and other members can answer to provide a community model (which customs broker should I use for cross-border to Canada?)</p>
	</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<h4>ACCESS TO ALL MODES OF TRANSPORTATION RATES</h4>
			<p>Members have a quick and easy way to access all modes for both domestic and international shipping:</p>
			<div class="row">
				<div class="col-md-6">
					<ul>
						<li>Parcel</li>
						<li>Drayage</li>
						<li>Ocean FCL</li>
					</ul>
				</div>
				<div class="col-md-6">
					<ul>
						<li>LTL / Haulage</li>
						<li>Air</li>
						<li>Ocean LCL</li>
					</ul>
				</div>
			</div>
		</div>		
		<div class="col-md-6">
			<h4>BUYING POWER</h4>
			<p>BCO Shipping Association members are able to pool their volumes together are substantially higher than any one member could provide on their own yielding better rates, better service and greater attention to customer needs by carriers for all members. Benchmarking and index reporting proves that BPO Power users save over 15% on average of their freight spend over non-Member rates.</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<h4>BROAD INDUSTRY KNOWLEDGE</h4>
			<p>BCO Shippers Association staff know all modes - from rural area surcharges on parcel shipments to how many MQC's should warrant a discount on ocean shipments. With constant and continuous member input, BCO Shippers Association always improves its offering.</p>
		</div>
		<div class="col-md-6">
			<h4>BROADER NEGOTIATING SKILLS</h4>
			<p>BCO Shippers Association realizes that members are depending on the buying power to keep costs low. Rate and service negotiation is key to the success of the organization.</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<h4>EXPANSIVE NETWORK OF RATES</h4>
			<p>If any member needs to find a rate that they've never shipped to, BCO Power is the perfect solution. With BUYING POWER, small shippers can benefit from the greater volume afforded by BCO Shippers Association as a whole.</p>
		</div>
		<div class="col-md-6">
			<h4>NON-PROFIT</h4>
			<p>Many associations assess a per shipment fee onto every shipment moved through their association. At BCO Shippers Association, there's no "per shipment" fee, but just an annual fee to pay for the administration of the organization.</p>
		</div>
	</div>
	
	<div class="row">
		<div class='col-md-12'>
			<h4>SHIPPING RATES</h4>
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
		<h3>Convinced?<h3>
		<h2>Sign up now!</h2>
		<p>Free till at least 2018, after that we'll offer you paid plans</p>
		<p>Or feel free to contact us if you have any questions</p>
		<a href="{{ url('/contact-us') }}" class="btn btn-default">Contact</a>
	</div>



</div>
{{-- @include('subscriptions.choices') --}}


<div class="spanner spanner-image" style="margin-bottom: -24px;">
	<div class="item" style="background-image: url('res/banner1-1200x376.jpg');">
	</div>
</div>

@endsection