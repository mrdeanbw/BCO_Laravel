@extends('layouts.app')

@section('content')

<div class="container info-page">
	<div class="row">
		<div class='col-md-12'>
		<h3>BCO POWER</h3>

			
			<p>BCO Shippers Association is a non-profit 501(c)3 organization that provides buying power in transportation services and technology offerings through its membership portal, BCO POWER.</p>
			<p>BCO Shippers Association (BCO) offers membership to importers and exporters of various products through volume buying power of transportation services such as parcel, less than truckload, drayage, air, and ocean. The members also receive technology benefits through the membership portal.
			</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<h3>The Board</h3>
			<p>The Board of Directors is composed of industry veterans that are committed to the BCO Shippers Association. Together, they help drive competitive shipping rates, best of breed technology, and other benefits to the members.</p>
			<table class="boardmembers">
				<tr class="boardmember">
					<td class="bm-img">
						<img src="http://cfb.069.myftpupload.com/wp-content/uploads/2016/08/member1-2.png" />				
					</td>
					<td class="bm-info">
						<h4>David Pearlman</h4>
						<p>Vice President of Logistics and Inventory Management</p>
						<p><strong>Welmed, Inc.</strong></p>
						<p>Chicago, IL</p>
					</td>
					<td class="bm-img">
						<img src="http://cfb.069.myftpupload.com/wp-content/uploads/2016/08/member4-1.png" />				
					</td>
					<td class="bm-info">
						<h4>Jennie Rice</h4>
						<p>Senior Procurement Specialist</p>
						<p><strong>KBR, Inc.</strong></p>
						<p>Amarillo, TX</p>
					</td>
				</tr>
				<tr class="boardmember">
					<td class="bm-img">
						<img src="http://cfb.069.myftpupload.com/wp-content/uploads/2016/08/member2-2.png" />
					</td>
					<td class="bm-info">
						<h4>Tina Roth</h4>
						<p>Trade Compliance Manager</p>
						<p><strong>DeLavel, Inc.</strong></p>
						<p>Kansas City, MO</p>
					</td>
					<td class="bm-img">
						<img src="http://cfb.069.myftpupload.com/wp-content/uploads/2016/08/member3-1.png" />
					</td>
					<td class="bm-info">
						<h4>Tim Hinckley</h4>
						<p>Senior Vice President - Global Logistics</p>
						<p><strong>Hasbro, Inc.</strong></p>
						<p>Boston, MA</p>
					</td>
				</tr>
			</table>
		</div>
	</div>

	<div class="action-box">		
		<h3>To apply for a membership today.</h3>		
		<a href="{{ url('/register') }}" class="btn btn-default">Register Here</a>
		<p>Free till at least 2018, after that we'll offer you paid plans</p>
	</div>

</div>



@endsection