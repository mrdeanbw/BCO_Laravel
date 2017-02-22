@extends('layouts.app')

@section('content')



  <div class="container-fluid">
    <div class="banner-block row is-table-row">
      <div class="col-md-1"></div>
      <div class="col-md-5 text-block">
        <p class="tag-line">FREIGHT PROCUREMENT DONE SMARTER</p>
        <h1><strong>LEVERAGE THE ASSOCIATION ADVANTAGE, TODAY.</strong></h1>
        <p>Together let's maximize your buying power.</p>
        <a href="{{ url('/register') }}" class="btn btn-primary btn-lg btn-sqr"> GET STARTED NOW</a>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5" style="background-image: url('/res/stock1.jpg'); background-size: cover; background-position: center;">        
      </div>      
    </div>
  

    <div class="banner-block row primary-bg">

      
      <div class="col-md-10 col-md-offset-1 text-block">

        <div class="row is-table-row">
          <div class="col-md-4 usp">
           <i class="fa fa-newspaper-o" aria-hidden="true"></i>
           <h3><strong>LATEST NEWS</strong></h3>
           <p>Industry updates, press releases, all collected and curated for you.</p>
         </div>
         <div class="col-md-4 usp">
           <i class="fa fa-line-chart" aria-hidden="true"></i>
           <h3><strong>ANALYTICS</strong></h3>
           <p>We'll provide you with benchmark reports, indices, and Trade Whitepapers</p>
         </div>
         <div class="col-md-4 usp">
           <i class="fa fa-usd" aria-hidden="true"></i>
           <h3><strong>SHIPPING RATES</strong></h3>
           <p>Get Parcel, Air, LTL/Ground, Ocean Shipping rates that don't break the bank,  in one place.</p>
         </div>

       </div>
     </div>     
    </div>

    <div class="banner-block row primary-bg">
      <div class="col-md-6 col-md-offset-3 text-block center top-border-light">
        <a href="{{ url('/register') }}" class="btn btn-default btn-lg btn-sqr">BECOME A MEMBER</a>
        <br />
        <br />
        <h2>
          AND FIND OUT WHY BCO POWER IS THE FASTEST GROWING SHIPPERS ASSOCIATION
        </h2>
        <br />
        <br />
        <h4>Click here and let us introduce you to all our member only advantages.</h4>
      </div>
    </div>

    <div class="banner-block row is-table-row">
      <div class="col-md-5 video-block">
        <video playsinline autoplay muted loop poster="images/bg.jpg" id="bgvid">
          <source src="/res/media/bcopower.webm" type="video/webm" />
          <source src="/res/media/bcopower.mp4" type="video/mp4" />
        </video>
      </div>
      <div class="col-md-1">
      </div>
      <div class="col-md-5 text-block">
      <p class="tag-line">NON-PROFIT REPRESENTATION</p>
      <h1><strong>BCO POWER IS A 501(c)3 ORGANIZATION DEDICATED TO HELPING ITS MEMBERS NAVIGATE THE MARKETPLACE</strong></h1>
      <a href="{{ url('/non-profit-status') }}" class="btn btn-primary btn-lg btn-sqr">LEARN MORE</a>
      </div>
      <div class="col-md-1">
      </div>

    </div>

     <div class="banner-block row primary-bg">

      
      <div class="col-md-10 col-md-offset-1 text-block">

        <div class="row is-table-row">
          <div class="col-md-4 usp">
            <i class="fa fa-rocket" aria-hidden="true"></i>
           <h3><strong>SOFTWARE</strong></h3>
                <p>Industry updates, press releases, all collected and curated for you.</p>
         </div>
         <div class="col-md-4 usp">
           <i class="fa fa-users" aria-hidden="true"></i>
           <h3><strong>Forums</strong></h3>
                <p>Learn from peers, exchange ideas and possibly acquire new business.</p>
         </div>
         <div class="col-md-4 usp">
           <i class="fa fa-usd" aria-hidden="true"></i>
           <h3><strong>SAVINGS</strong></h3>
           <p>Members Save Big On Parcel, LTL/Ground, Air, and Ocean Shipping Rates.</p>
         </div>

       </div>
     </div>     
    </div>

 </div>


@endsection

@section('js')

@endsection