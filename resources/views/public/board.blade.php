@extends('layouts.app')

@section('content')
<div class="spanner info-page spanner-image">
	<div class="item" style="background-image: url('res/banner1-1200x376.jpg');">
		<div class="container">
			<div class="caption">
				<h3>BCO Power Board</h3>              
			</div>
		</div>
	</div>
</div>


<div class="container info-page">
	<br>
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

	<div class="action-box">
		<h2>Want to take advantage of our buying power?</h2>
		<h3>Register today.</h3>		
		<a href="{{ url('/register') }}" class="btn btn-default">Register Here</a>
	</div>

</div>



@endsection