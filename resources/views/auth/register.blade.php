@extends('layouts.app')



@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3><i class="fa fa-user-plus primary" aria-hidden="true"></i> Register <small class="subtle">(step 1 of 3)</small></h3>
            <div class="well">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                    {{ csrf_field() }}
                    @if(null !== Request::get('cpl'))
                    {{ Form::hidden('plan_id', Request::get('cpl'), array('id' => 'plan_id')) }}
                    {{ Form::hidden('trial', Request::get('t'), array('id' => 'trial')) }}
                    @endif
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-8">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-8">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="form-group{{ $errors->has('organization') ? ' has-error' : '' }}">
                        <label for="Organization" class="col-md-4 control-label">Organization</label>

                        <div class="col-md-8">
                            <input id="organization" type="text" class="form-control" name="organization" value="{{ old('organization') }}" required autofocus>

                            @if ($errors->has('organization'))
                            <span class="help-block">
                                <strong>{{ $errors->first('organization') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('city') || $errors->has('country') ? ' has-error' : '' }}">
                        <label for="city" class="col-md-4 control-label">City</label>

                        <div class="col-md-8">
                            <location-widget></location-widget>

                            @if ($errors->has('city'))
                            <span class="help-block">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                            @endif
                            @if ($errors->has('country'))
                            <span class="help-block">
                                <strong>{{ $errors->first('country') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-8">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-8">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                            @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <h3>Please help us to get to know your business</h3>

                    <div class="form-group">
                        <label class="col-md-4 control-label">I am a</label>
                        <div class="col-md-8">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="type" id="optionsRadios1" value="exporter" checked>
                                    Exporter
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="type" id="optionsRadios2" value="importer">
                                    Importer
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="type" id="optionsRadios3" value="both">
                                    Both
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('commodity') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">My primary commodity is</label>
                        <div class="col-md-8">                                
                            <select name="commodity" class="form-control">                                    
                                <option value="recycled">Recycled/Scrap paper, plastic, or metals</option>
                                <option value="packaging">Packaging or Finished Paper</option>
                                <option value="agricultural">Agricultural grains, cotton</option>
                                <option value="foodstuffs">Foodstuffs</option>
                                <option value="chemicals">Chemicals, plastics</option>
                                <option value="pharmaceuticals">Pharmaceuticals</option>
                                <option value="minerals">Minerals</option>
                                <option value="construction">Construction - building materials</option>
                                <option value="manufacturing">Manufacturing parts</option>
                                <option value="electornics">Electronics</option>
                                <option value="retail">Retail</option>
                                <option value="fashion">Fashion</option>
                                <option value="beverages">Beverages</option>
                                <option value="oil">Oil &amp; Gas</option>
                                <option value="government">Govt/Defense</option>
                                <option value="other">Other</option>
                            </select>
                            @if ($errors->has('commodity'))
                            <span class="help-block">
                                <strong>{{ $errors->first('commodity') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Special needs</label>
                        <div class="col-md-8">                                                                
                            <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="perishable"> Perishable
                              </label>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="hazardous"> Hazardous
                          </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="fragile"> Fragile
                      </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="liquid"> Liquid
                  </label>
              </div>
          </div>
      </div>                        

      <hr>

      <div class="form-group{{ $errors->has('recaptcha') ? ' has-error' : '' }}">
        <div class="col-md-8 col-md-offset-4">
            <div id="recaptcha" name="recaptcha" class="g-recaptcha" data-sitekey="6LdYnQoUAAAAAFW6eqyIixhyQbOWxHQmHQM_vjzH"></div>
            @if ($errors->has('recaptcha'))
            <span class="help-block">
                <strong>{{ $errors->first('recaptcha') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Register
            </button>
        </div>
    </div>
</form>
</div>

</div>
</div>
</div>
@endsection

@section('js')
<script src="/js/pwstrength-bootstrap.min.js" type="text/javascript"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
      $('#password').pwstrength({ui: { showVerdictsInsideProgressBar: true, progressBarEmptyPercentage: 0}, common: {minChar: 6}});
</script>
@endsection