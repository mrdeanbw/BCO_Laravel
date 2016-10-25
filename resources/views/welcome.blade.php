@extends('layouts.app')

@section('content')
<div class="spanner spanner-dark">
    <div class="container">
     <div class="row">
        <div class="col-md-2 col-xs-12">
            <div class="md">
                <div class="md-icon">
                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                </div>
                <h4><strong>LATEST NEWS</strong></h4>
                <p>Industry updates, press releases, all collected and curated for you.
            </div>
        </div>
        <div class="col-md-2 col-xs-12">
        <div class="md">
            <div class="md-icon">
                <i class="fa fa-line-chart" aria-hidden="true"></i>
            </div>
            <h4><strong>ANALYTICS</strong></h4>
            <p>Benchmark reports, Indices, Trade Whitepapers</p>
            </div>
        </div>
        <div class="col-md-2 col-xs-12">
            <div class="md">
                <div class="md-icon">
                    <i class="fa fa-usd" aria-hidden="true"></i>
                </div>
                <h4><strong>SHIPPING RATES</strong></h4>
                <p>Get Parcel, Air, LTL/Ground, Ocean Shipping rates in one place.</p>
            </div>
        </div>
        <div class="col-md-6">
        <div class="spanner-text-pane">
            <h2>
                Find out why BCO Power is the fastest growing Shippers Association
            </h2>
            <p>
                <a href="">View all of our member-only advantages</a> or <a href="{{ url('/register') }}" class="btn btn-primary btn-sm">become a member</a> now!
            </p>
        </div>
        </div>
    </div>
</div>
</div>
@endsection
