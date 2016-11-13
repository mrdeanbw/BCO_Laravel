@extends('layouts.app')

@section('content')
<div class="navbar-cancelmargin"></div>
<div class="spanner  spanner-image">
    <div class="item" style="background-image: url(/res/s03-1200x534.jpg);">
      <div class="container">
          <div class="caption">
              <h3>SHIPPING SAVINGS</h3>
              <p>Members Save Big On Parcel, LTL/Ground, Air, and Ocean Shipping Rates</p>
              <button class="btn btn-primary" id="btn-save">Learn More</button>
          </div>
      </div>
  </div>
  <div id="savings-expander" class="spanner-expander exp-collapsed">  
    <div class="container">
        <div class="expander-header">
            <h3>
                Members Save Big on Shipping Rates
                <button id="btn-save-close" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </h3>        
        </div>
        <canvas id="myChart" class="container"></canvas>
    </div>
</div>
</div>



<div class="spanner spanner-dark">
    <div class="container">
     <div class="row">
        <div class="col-md-2 col-xs-12">
            <div class="usp">
                <div class="usp-icon">
                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                </div>
                <h4><strong>LATEST NEWS</strong></h4>
                <p>Industry updates, press releases, all collected and curated for you.</p>
            </div>
        </div>
        <div class="col-md-2 col-xs-12">
            <div class="usp">
                <div class="usp-icon">
                    <i class="fa fa-line-chart" aria-hidden="true"></i>
                </div>
                <h4><strong>ANALYTICS</strong></h4>
                <p>Benchmark reports, Indices, Trade Whitepapers</p>
            </div>
        </div>
        <div class="col-md-2 col-xs-12">
            <div class="usp">
                <div class="usp-icon">
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

<div class="spanner spanner-image">
    <div class="item" style="background-image: url(/res/s01-1200x534.jpg);">
      <div class="container">
          <div class="caption right">
              <h3>BUYING POWER</h3>
              <p>When Shippers Pool Their Volume Together Everone Wins</p>
              <a href="{{ url('/why-join') }}" class="btn btn-primary">Learn More</a>
          </div>
      </div>
  </div>
</div>

<div class="spanner spanner-light">
    <div class="container">
     <div class="row">
         <div class="col-md-6">
            <div class="spanner-text-pane" style="text-align: right;">
                <h2>
                    Don't get left behind and take full advantage of your BCO Power!
                </h2>
                <p>
                    <a href="{{ url('/register') }}" class="btn btn-default btn-sm">Become a member</a> now!
                </p>
            </div>
        </div>
        <div class="col-md-2 col-xs-12">
            <div class="usp">
                <div class="usp-icon">
                    <i class="fa fa-rocket" aria-hidden="true"></i>
                </div>
                <h4><strong>SOFTWARE</strong></h4>
                <p>Industry updates, press releases, all collected and curated for you.</p>
            </div>
        </div>
        <div class="col-md-2 col-xs-12">
            <div class="usp">
                <div class="usp-icon">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </div>
                <h4><strong>Forums</strong></h4>
                <p>Learn from peers, exchange ideas and possibly acquire new business.</p>
            </div>
        </div>
        <div class="col-md-2 col-xs-12">
            <div class="usp">
                <div class="usp-icon">
                    <i class="fa fa-usd" aria-hidden="true"></i>
                </div>
                <h4><strong>SHIPPING RATES</strong></h4>
                <p>Get Parcel, Air, LTL/Ground, Ocean Shipping rates in one place.</p>
            </div>
        </div>        
    </div>
</div>
</div>

<div class="spanner spanner-image" style="margin-bottom: -24px;">
    <div class="item" style="background-image: url(/res/s02-1200x534.jpg);">
        <div class="container">
          <div class="caption">
            <h3>NON-PROFIT</h3>
            <p>BCO Shippers Association is a 501(c)3 organization dedicated to serving its members to gain BCO Power!</p>
        <a href="{{ url('non-profit-status') }}" class="btn btn-primary">Learn More</a>
        </div>
    </div>
</div>



        


<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
{{ Html::script('js/home.js') }}

@endsection

@section('js')
    
@endsection