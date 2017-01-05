@extends('users.profile')

@section('details')	

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <br>

    <div class="btn-group btn-group-sm" role="group" aria-label="...">
	    @if( ! $subscription->cancel_at_period_end)	
		    
		    <a href="{{url('subscriptions/choose')}}" class="btn btn-primary">Change your Plan</a>	
		    		    
		    <a href="{{url('subscriptions/'.$user->id.'/card')}}"  class="btn btn-default">Update your payment details</a>

		    <a href="{{url('subscriptions/'.$user->id.'/cancel')}}"  class="btn btn-default">Cancel your Subscription</a>
            <a href="{{url('subscriptions/testmail')}}" class="btn btn-default">Test</a>
		    
	    @else
		    
		    <a href=""  class="btn btn-primary">Reactivate Subscription</a>
		    
	    @endif
    </div>

    <br><br>

    <div class="row">
    	<div class="col-md-4">
    		Subscription
    	</div>
    	<div class="col-md-8">
    		<span>{{ $subscription->plan->name }} {!! !$subscription->cancel_at_period_end ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Cancelled</span>'!!}</span>    		
    	</div>
    </div>

    <div class="row">
    	<div class="col-md-4">
    		Subscribed on
    	</div>
    	<div class="col-md-8">
    		{{ date('d M y', $subscription->created) }}
    	</div>
    </div>

    <div class="row">
    	<div class="col-md-4">
    		Amount
    	</div>
    	<div class="col-md-8">
    		{{ strtoupper($subscription->plan->currency) }} {{ ($subscription->plan->amount / 100) }} / {{ $subscription->plan->interval }}
    	</div>
    </div>

    <div class="row">
    	<div class="col-md-4">
    		Current Billing Period
    	</div>
    	<div class="col-md-8">
    		{{ date('d M y', $subscription->current_period_start) }} to {{ date('d M y', $subscription->current_period_end) }}
    	</div>
    </div>

    <div class="row">
    	<div class="col-md-4">
    		Payment details
    	</div>
    	<div class="col-md-8">
    		{{ $user->card_brand }} &bull;&bull;&bull;&bull;  &bull;&bull;&bull;&bull;  &bull;&bull;&bull;&bull; {{ $user->card_last_four }}
    	</div>
    </div>

    <div class="row">
        <div class="col-md-4">
            Subscription notes
        </div>
        <div class="col-md-8">
            @if($subscription->cancel_at_period_end)
                This subscription has been cancelled on {{date('d M y', $subscription->canceled_at)}} and will expire at the current period end.
            @endif
        </div>
    </div>
	
	

	
	
	
@endsection
