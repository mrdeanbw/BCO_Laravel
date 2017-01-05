@extends('layouts.app')

@section('css')
<style>
        .alert.parsley {
            margin-top: 5px;
            margin-bottom: 0px;
            padding: 10px 15px 10px 15px;
        }
        .check .alert {
            margin-top: 20px;
        }
        .credit-card-box .panel-title {
            display: inline;
            font-weight: bold;
        }
        .credit-card-box .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 100%;
        }
        .credit-card-box .display-tr {
            display: table-row;
        }
    </style>
@endsection

@section('content')

<div class="container">	
	<div class="col-md-6 col-md-offset-3">
		<h3><i class="fa fa-credit-card primary"></i> Checkout</h3>
		<ul class="ul-no-indent">
			<li>You are purchasing the <strong>{{ $plan->name }}</strong> plan</li>
			<li>You will pay <strong>${{ ($plan->amount / 100) }}</strong> now</li>			
			<li>Your subscription fee will be automatically charged to your card each <strong>{{ $plan->interval }}</strong></li>
		</ul>
		{!! Form::open(['url' => 'subscriptions', 'id' => 'payment-form']) !!}
		{{ Form::hidden('plan_id', $plan->id, array('id' => 'plan_id')) }}		
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ $message }}</strong>
        </div>
        @endif
        <div class="well">
        	<div class="form-group" id="name-group">
			{{ Form::label(null, 'Name on Card') }} <span class="pull-right subtle"><i class="fa fa-lock" aria-hidden="true"></i> Secured</span>
			{{ Form::text(null, null, [
				'class'			=> 'form-control',
				'required'  	=> 'required',
				'data-stripe'	=> 'name',								
				'maxlength'     => '40'
				]) }}
			</div>
			<div class="form-group" id="cc-group">
			{{ Form::label(null, 'Credit card number') }}
			{{ Form::text(null, null, [
				'class'			=> 'form-control',
				'required'  	=> 'required',
				'data-stripe'	=> 'number',				
				'data-parsley-type'             => 'number',
				'maxlength'                     => '16'
				]) }}
			</div>

			<div class="form-group" id="ccv-group">
				{!! Form::label(null, 'CVC (3 or 4 digit number)') !!}
				{!! Form::text(null, null, [
						'class'                         => 'form-control',
						'required'                      => 'required',
						'data-stripe'                   => 'cvc',                        
						'data-parsley-type'             => 'number',
						'data-parsley-trigger'          => 'change focusout',
						'maxlength'                     => '4',
						'data-parsley-class-handler'    => '#ccv-group'                        
					]) !!}
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group" id="exp-m-group">
						{!! Form::label(null, 'Expiry Month') !!}
						{!! Form::selectMonth(null, null, [
							'class'                 => 'form-control',
							'required'              => 'required',
							'data-stripe'           => 'exp-month'
							], '%m') !!}
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group" id="exp-y-group">
						{!! Form::label(null, 'Year') !!}
						{!! Form::selectYear(null, date('Y'), date('Y') + 10, null, [
							'class'             => 'form-control',
							'required'          => 'required',
							'data-stripe'       => 'exp-year'
							]) !!}
					</div>
				</div>
			</div>
			<div class="form-group">
            	{!! Form::submit('Securely place your subscription order', ['class' => 'btn btn-lg btn-block btn-primary btn-order', 'id' => 'submitBtn', 'style' => 'margin-bottom: 10px;']) !!}
            </div>
			<div class="row">
				<div class="col-md-12">
				    <span class="payment-errors" style="color: red;margin-top:10px;"></span>
				</div>
			</div>
			{{ Form::close() }}
			</div>
		<div class="payment-footer subtle">
		<p>Your subscription will be securely processed by Stripe Inc., we ourselves do not store any of your credit card information on our servers apart from the last 4 digits of your card number and the brand, for verification purposes.</p>
		</div>
		</div>
	</div>	

	@endsection

	@section('js')

 

	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script>
	        Stripe.setPublishableKey("<?php echo env('STRIPE_PUBLISHABLE_KEY') ?>");
	        jQuery(function($) {
	            $('#payment-form').submit(function(event) {
	                var $form = $(this);	                
	                $form.find('#submitBtn').prop('disabled', true);
	                Stripe.card.createToken($form, stripeResponseHandler);
	                return false;
	            });
	        });
	        function stripeResponseHandler(status, response) {
	            var $form = $('#payment-form');
	            if (response.error) {
	                $form.find('.payment-errors').text(response.error.message);
	                $form.find('.payment-errors').addClass('alert alert-danger');
	                $form.find('#submitBtn').prop('disabled', false);
	                $('#submitBtn').button('reset');
	            } else {
	                var token = response.id;
	                $form.append($('<input type="hidden" name="stripeToken" />').val(token));
	                $form.get(0).submit();
	            }
	        };
	    </script>

	@endsection