@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Member Information Hub</h2>
    <div class="alert alert-warning" role="alert"><strong>Warning</strong>   &bull;   Your BCO Power membership is expiring <a href="#">Extend Now</a></div>
    <div class="row">
        <div class="col-md-4">            
            <stock-app symbols="'EXPD', 'JBHT', 'UPS', 'FDX', 'CHRW'"></stock-app>
            <market-news></market-news>     
        </div>
        <div class="col-md-8">
            <latest-news></latest-news>
            <new-members></new-members>
        </div>
    </div>
</div>


@endsection

