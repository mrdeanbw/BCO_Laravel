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
	<div class="col-md-8 col-md-offset-2">
		<h3>{{ $plan->name }}</h3>
		<p>{{ strtoupper($plan->currency)}} {{ ($plan->amount / 100) }} per {{ $plan->interval }}</p>

		{!! Form::open(['url' => 'subscriptions', 'data-parsley-validate', 'id' => 'payment-form']) !!}
		{{ Form::hidden('plan_id', $plan->id, array('id' => 'plan_id')) }}
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ $message }}</strong>
        </div>
        @endif
		<div class="form-group" id="cc-group">
			{{ Form::label(null, 'Credit card number:') }}
			{{ Form::text(null, null, [
				'class'			=> 'form-control',
				'required'  	=> 'required',
				'data-stripe'	=> 'number',				
				'data-parsley-type'             => 'number',
				'maxlength'                     => '16',
				'data-parsley-trigger'          => 'change focusout',
				'data-parsley-class-handler'    => '#cc-group'
				]) }}
			</div>

			<div class="form-group" id="ccv-group">
				{!! Form::label(null, 'CVC (3 or 4 digit number):') !!}
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
						{!! Form::label(null, 'Ex. Month') !!}
						{!! Form::selectMonth(null, null, [
							'class'                 => 'form-control',
							'required'              => 'required',
							'data-stripe'           => 'exp-month'
							], '%m') !!}
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group" id="exp-y-group">
						{!! Form::label(null, 'Ex. Year') !!}
						{!! Form::selectYear(null, date('Y'), date('Y') + 10, null, [
							'class'             => 'form-control',
							'required'          => 'required',
							'data-stripe'       => 'exp-year'
							]) !!}
					</div>
				</div>
			</div>
			<div class="form-group">
            	{!! Form::submit('Place your subscription order', ['class' => 'btn btn-lg btn-block btn-primary btn-order', 'id' => 'submitBtn', 'style' => 'margin-bottom: 10px;']) !!}
             </div>
			<div class="row">
				<div class="col-md-12">
				    <span class="payment-errors" style="color: red;margin-top:10px;"></span>
				</div>
			</div>

			{{ Form::close() }}

		</div>
	</div>	

	@endsection

	@section('js')

	<!-- PARSLEY -->
    <script>
        window.ParsleyConfig = {
            errorsWrapper: '<div></div>',
            errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
            errorClass: 'has-error',
            successClass: 'has-success'
        };
    </script>
    
    <script src="http://parsleyjs.org/dist/parsley.js"></script>

	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script>
	        Stripe.setPublishableKey("<?php echo env('STRIPE_PUBLISHABLE_KEY') ?>");
	        jQuery(function($) {
	            $('#payment-form').submit(function(event) {
	                var $form = $(this);
	                $form.parsley().subscribe('parsley:form:validate', function(formInstance) {
	                    formInstance.submitEvent.preventDefault();
	                    alert();
	                    return false;
	                });
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