@extends('dashboard')
@section('dashboard-content')

    <div class="marketnews dashboard-block">
        <h3><i class="fa fa-retweet" aria-hidden="true"></i> Refer A Colleague</h3>    
        
        <form role="form" method="POST" action="{{ url('/members/refer') }}">
            {{ csrf_field() }}
            <br>
            @if (Session::has('message'))
            <div class="panel-body">
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            </div>
            @endif
            <p>Send a message to your colleagues or business partners to let them know about BCO Power.</p>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <label>First Name</label>
                    <input type="text" class="form-control" placeholder="Their first name" name="first_name" value="{{ old('first_name') }}" required>
                    @if ($errors->has('first_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                    @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label>Last Name</label>
                        <input type="text" class="form-control" placeholder="Their last name" name="last_name" value="{{ old('last_name') }}" required>             
                        @if ($errors->has('last_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="">Email</label>
                        <input type="email" class="form-control" placeholder="Email address you'd like to refer them on" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group {{ $errors->has('message') ? ' has-error' : '' }}">
                        <label for="">Message</label>
                        <textarea id="" cols="30" rows="7" class="form-control" name="message"  required>{{ old('messsage') }}</textarea>
                        @if ($errors->has('message'))
                        <span class="help-block">
                            <strong>{{ $errors->first('message') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group {{ $errors->has('phonenumber') ? ' has-error' : '' }}">
                        <label for="">Phone number <span class="subtle">(optional)</span></label>
                        <input type="text" class="form-control" name="phonenumber" value="{{old('phonenumber')}}">
                         @if ($errors->has('phonenumber'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phonenumber') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group checkbox {{ $errors->has('agree') ? ' has-error' : '' }}">
                        <label>
                            <input type="checkbox" name="agree"> I confirm it's appropriate for BCO Power to use the details provided to contact my referral.
                        </label>
                        @if ($errors->has('agree'))
                        <span class="help-block">
                            <strong>You must agree to continue the referral</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-retweet" aria-hidden="true"></i> REFER</button>
        </form>
        
    </div>

@endsection