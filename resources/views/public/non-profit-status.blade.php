@extends('layouts.app')

@section('content')

<div class="container info-page">
	<div class="row">
		<div class='col-md-12'>
		<h3>BCO POWER IS A NON-PROFIT CORPORATATION</h3>

			
			<p>BCO Shippers Association is a 501(c)3 non-profit corporation organized in the state of Delaware, USA.
BCO Shippers Association does not have any shareholders; instead it is operated by its members and under the by-laws approved by its Board of Directors and also by the Shipping Act of 1984.</p>
			<p>Shipping Act Definition of Shipper’s Association: The Act defines a Shipper’s Association pursuant to 46 U.S. Code § 40102 (23) as follows:
			</p>
			<p>The term “shippers’ association” means a group of shippers that consolidates or distributes freight on a nonprofit basis for the members of the group to obtain carload, truckload, or other volume rates or service contracts.</p>
			<p>Activities under the BCO Shippers Association are “on a non-profit basis.”</p>
			<p>The Rules and Regulations of the Federal Maritime Commission requires that ocean common carriers must negotiate in good faith with shipper associations. The FMC regulations further state that an ocean carrier “may not require a shippers’ association to obtain or apply for a Business Review Letter from the Department of Justice prior to or as part of a service contract negotiation process.” The regulation states the following:</p>
			<p>§545.1 Interpretation of Shipping Act of 1984—Refusal to negotiate with shippers’ associations. (a) 8(c) of the Shipping Act of 1984 (“the Act”) (46 U.S.C. 40502) authorizes ocean common carriers and agreements between or among ocean common carriers to enter into a service contract with a shippers’ association, subject to the requirements of the Act. Section 10(b)(10) of the Act (46 U.S.C. 41104(10)) prohibits carriers from unreasonably refusing to deal or negotiate. Section 7(a)(2) of the Act (46 U.S.C. 40307(a)(3)) exempts from the antitrust laws any activity within the scope of that Act, undertaken with a reasonable basis to conclude that it is pursuant to a filed and effective agreement. 3 (b) The Federal Maritime Commission interprets these provisions to establish that a common carrier or conference may not require a shippers’ association to obtain or apply for a Business Review Letter from the Department of Justice prior to or as part of a service contract negotiation process.
			</p>			
		</div>
	</div>

	<div class="action-box">
		<h2>Want to take advantage of our buying power?</h2>
		<h3>Register today.</h3>		
		<a href="{{ url('/register') }}" class="btn btn-default">Register Here</a>
		<p>Free till at least 2018, after that we'll offer you paid plans</p>
	</div>

</div>



@endsection