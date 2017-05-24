<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>The association for, and by shippers - {{ config('app.name', 'Laravel') }}</title>


    <meta name="description" content="BCO Power is a non-profit shippers association, preparing to launch in Fall 2017">
    <meta name="keywords" content="Freight,Logistics,Shippers,BCO,Power,Association,Non-Profit">
    <meta name="author" content="Qwyk B.V.">    
    <meta name="msapplication-TileColor" content="#24CBD3">
    <meta name="msapplication-TileImage" content="ms-icon-144x144.png">
    <meta name="theme-color" content="#24CBD3">

    <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="manifest.json">


    <link href="/css/appnew.css" rel="stylesheet">

    @yield('css')
    @if(Request::is( Config::get('chatter.routes.home') ) || Request::is( Config::get('chatter.routes.home') . '/*' ))
        <!-- LINK TO YOUR CUSTOM STYLESHEET -->
        <link rel="stylesheet" href="/css/forums.css" />
    @endif

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app">
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">

			<div class="navbar-header">
				<a class="hidden-xs" href="/"><img class="logo" src="{{ url('/res/logo-2.png') }}" /></a>

				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

				<a class="navbar-brand visible-xs" href="{{ url('/') }}">{{ config('app.name', 'BCO Power') }}</a>
			</div>

			<div class="collapse navbar-collapse" id="app-navbar-collapse">
				<ul class="nav navbar-nav">
					@if (Auth::guest()) 
						<li><a href="/who-we-are">Who We Are</a></li>
						<li class="hidden-xs"><p>|</p></li>
						<li><a href="/why-join">Why Join</a></li>
						<li class="hidden-xs"><p>|</p></li>
						<li><a href="/non-profit-status">Non Profit Status</a></li>						
						<li class="hidden-xs"><p>|</p></li>						
						<li><a href="/contact-us">Contact Us</a></li>
					@else
						<li><a class="{{ Request::is('members') ? 'active' : ''}}" href="{{ url('/members') }}">Members Area</a></li>
                        <li class="hidden-xs"><p>|</p></li>
                        <li><a class="{{ Request::is('members/news*') ? 'active' : ''}}" href="{{ url('/members/news') }}">News</a></li>
						<li class="hidden-xs"><p>|</p></li>
						<li><a class="{{ Request::is('members/forums*') ? 'active' : ''}}" href="{{ url('/members/forums') }}">PowerGRID</a></li>
						<li class="hidden-xs"><p>|</p></li>
                         @if(Auth::user()->admin_verifier)
                        <li><a class="{{ Request::is('members/rates*') ? 'active' : ''}}" href="{{ url('/members/rates') }}">Shipping Rates</a></li>
                        <li class="hidden-xs"><p>|</p></li>
                        @endif
                        <li><a class="{{ Request::is('members/software*') ? 'active' : ''}}" href="{{ url('/members/software') }}">Partners</a></li>
                         @if(Auth::user()->admin_verifier)
                        <li class="hidden-xs"><p>|</p></li>
                        <li><a class="{{ Request::is('members/directory*') ? 'active' : ''}}" href="{{ url('/members/directory') }}">Directory</a></li>
                        @endif
                        @if(Auth::user()->is_admin)
                        <li class="hidden-xs"><p>|</p></li>
                        <li><a class="{{ Request::is('admincp/*') ? 'active' : ''}}" href="{{ url('/admincp/') }}"><strong>AdminCP</strong></a></li>
                        @endif
					@endif
				</ul>



				<ul class="nav navbar-nav navbar-right">
					@if(Auth::guest()) 
						<li><a href="{{ url('/login') }}">Login</a></li>
						<li class="hidden-xs"><p>|</p></li>
                        <li><a href="{{ url('/register') }}"><strong class="primary highlight">Sign Up Today</strong></a></li>
                    @else 
                    	<li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <?php $noti_count= count(Auth::user()->unreadNotifications);  ?>
                                    @if($noti_count > 0) 
                                        <span class="badge">{{ $noti_count }}</span>
                                    @endif
                                    <i class="fa fa-user-circle" aria-hidden="true"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('users/'.Auth::user()->id.'/edit') }}"><i class="fa fa-id-badge" aria-hidden="true"></i> Your Profile</a></li>

                                    @if(Auth::user()->is_subscribed())
                                    <li><a href="{{ url('subscriptions/'.Auth::user()->id.'/edit') }}"><i class="fa fa-credit-card" aria-hidden="true"></i> Your Subscription</a></li>
                                    @endif

                                    <li><a href="{{ url('users/privacy/'.Auth::user()->id) }}"><i class="fa fa-shield" aria-hidden="true"></i> Privacy Settings</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ url('users/inbox/'.Auth::user()->id) }}"><i class="fa fa-inbox" aria-hidden="true"></i> Inbox @if($noti_count > 0) 
                                        <span class="badge">{{ $noti_count }}</span>
                                    @endif</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>


					@endif
				</ul>
			</div>

		</div>
	</nav>

	<div id="content">
		@yield('content')
	</div>
</div>
	<!-- Scripts -->
    <script src="/js/app.js"></script>
    @yield('js')
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', '{{ env('GOOGLE_TRACKINGID') }}', 'auto');
        ga('send', 'pageview');

    </script>
</body>
</html>