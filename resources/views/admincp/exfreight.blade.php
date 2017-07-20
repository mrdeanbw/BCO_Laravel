@extends('layouts.app')

@section('content')
<div class="container">
<div class="row" style="margin-top: 20px;">
<div class="col-md-6 col-md-offset-3">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Add ExFreight Credentials</h3>
        </div>
        <div class="panel-body">
            {{Form::open(['method'=>'POST', 'url'=>url('/admincp/u/exfreight/'.$user->id), 'class' => 'form-horizontal'])}}
            
                <div class="form-group">
                    <label for="name" class="col-md-4 control-label">Name</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" value="{{$user->name}}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-md-4 control-label">Email</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" value="{{$user->email}}" disabled>
                    </div>
                </div>
                <hr></hr>
                <h4>ExFreight Credentials</h4>
                <div class="form-group {{ $errors->has('exf_username') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">API Username</label>
                    <div class="col-md-8">
                        <input name="exf_username" type="text" class="form-control" value="{{old('exf_username') ?? $user->exf_username}}" required>
                         @if ($errors->has('exf_username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('exf_username') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('exf_apitoken') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">API Token</label>
                    <div class="col-md-8">
                        <input name="exf_apitoken" type="text" class="form-control" value="{{ old('exf_apitoken') ?? $user->exf_apitoken}}" required>
                        @if ($errors->has('exf_apitoken'))
                        <span class="help-block">
                            <strong>{{ $errors->first('exf_apitoken') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{url('/admincp')}}" class="btn btn-default">Return</a>
            {{ Form::close()}}
        </div>
    </div>
    </div>
    </div>
</div>
@endsection
