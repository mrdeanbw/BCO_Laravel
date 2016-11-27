<div class="spanner spanner-dark">
	<div class="container">
		<div class="row">
			<div class="col-md-4 subplan-box">
				<div class="subplan-box-title">
					<h4>Standard</h4>
					<h1><small>$</small> 24<small>.00</small></h1>
					<p>per month</p>
				</div>
				<div>
				@if(Auth::guest())
					<a href="{{ url('register?cpl=bronze') }}" class="btn btn-primary btn-lg">Buy Standard</a>
				@else
					@if(!isset($subscription) or $subscription->stripe_plan != 'bcopower-bronze')
						@if(!isset($subscription)) 
							<a href="{{ url('subscriptions/checkout/bronze') }}" class="btn btn-primary btn-lg">Buy Standard</a>
						@else
							{!! Form::model($subscription, ['route' => ['subscriptions.update', Auth::user()->id], 'method' => 'PUT']) !!}
							{{ Form::submit('Switch to Standard', array('class' => 'btn btn-primary')) }}
							{{ Form::hidden('plan_id', 'bcopower-bronze', array('id' => 'plan_id')) }}
							{!! Form::close() !!}
						@endif
					@else
						<a href="" disabled class="btn btn-default">Your Current Plan</a>
					@endif
				@endif
				</div>
				<div class="subplan-box-breaker">
					<strong>Standard includes</strong>					
				</div>
				<ul class="ul-no-indent">
					<li>Access to the BCO Power HUB and forums</li>
					<li>Monthly industry updates</li>

				</ul>
			</div>
			<div class="col-md-4 subplan-box">
				<div class="subplan-box-title">
					<h4>Plus</h4>
					<h1><small>$</small> 89<small>.00</small></h1>
					<p>per month</p>
				</div>			
				<div>
				@if(Auth::guest())
					<a href="{{ url('register?cpl=silver') }}" class="btn btn-primary btn-lg">Buy Plus</a>					
				@else
					@if(!isset($subscription) or $subscription->stripe_plan != 'bcopower-silver')
						@if(!isset($subscription)) 
							<a href="{{ url('subscriptions/checkout/silver') }}" class="btn btn-primary btn-lg">Buy Plus</a>
						@else
							{!! Form::model($subscription, ['route' => ['subscriptions.update', Auth::user()->id], 'method' => 'PUT']) !!}
							{{ Form::submit('Switch to Plus', array('class' => 'btn btn-primary')) }}
							{{ Form::hidden('plan_id', 'bcopower-silver', array('id' => 'plan_id')) }}
							{!! Form::close() !!}
						@endif
					@else
						<a href="#" disabled class="btn btn-default">Your Current Plan</a>
					@endif
				@endif
				</div>
				<div class="subplan-box-breaker">
					<strong>Plus includes</strong>					
				</div>
				<ul class="ul-no-indent">
					<li>BCO Power Rate System of Ground, Air, and Ocean rates</li>
					<li>BCO Power HUB and forums</li>
					<li>Monthly industry updates</li>
				</ul>
			</div>
			<div class="col-md-4 subplan-box">			
				<div class="subplan-box-title">
					<h4>Premiere</h4>
					<h1><small>$</small> 399<small>.00</small></h1>
					<p>per month</p>
				</div>
				<div>
				@if(Auth::guest())
					<a href="{{ url('register?cpl=gold') }}" class="btn btn-primary btn-lg">Buy Premiere</a>				
				@else
					@if(!isset($subscription) or $subscription->stripe_plan != 'bcopower-gold')
						@if(!isset($subscription)) 
							<a href="{{ url('subscriptions/checkout/gold') }}" class="btn btn-primary btn-lg">Buy Premiere</a>					
						@else
							{!! Form::model($subscription, ['route' => ['subscriptions.update', Auth::user()->id], 'method' => 'PUT']) !!}
							{{ Form::submit('Switch to Premiere', array('class' => 'btn btn-primary')) }}
							{{ Form::hidden('plan_id', 'bcopower-gold', array('id' => 'plan_id')) }}
							{!! Form::close() !!}
						@endif
					@else
						<a href="" disabled class="btn btn-default">Your Current Plan</a>
					@endif
				@endif
				</div>
				<div class="subplan-box-breaker">
					<strong>Premiere includes</strong>					
				</div>
				<ul class="ul-no-indent">
					<li>BCO Power rates, negotiated on your behalf with air- and ocean carriers, and transport providers</li>
					<li>BCO Power Rate System of Ground, Air, and Ocean rates</li>
					<li>Access to the BCO Power HUB and forums</li>
					<li>Monthly industry updates</li>
				</ul>
				<div>
				@if(Auth::guest())					
					<a href="{{ url('/register?cpl=gold&t=1') }}" class="btn btn-default">Or take a 14 day trial</a>
				@else
					@if(!isset($subscription))												
						<a href="{{ url('/subscriptions/checkout/gold?t=1') }}" class="btn btn-default">Or take a 14 day trial</a>
					@endif
				@endif
				</div>

			</div>
		
		</div>
	</div>
</div>