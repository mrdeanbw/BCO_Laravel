<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>The association for, and by shippers - {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

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
        <div class="app-header container hidden-xs">
            <a href="{{ url('/') }}"><img class="pull-left" src="{{ url('/res/logo-1.png') }}" /></a>
            <h2 class="pull-right">BCO Shippers Association</h2>
        </div>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand visible-xs" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if (Auth::guest()) 
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Why Join</a></li>
                            <li><a href="#">Non Profit Status</a></li>
                            <li><a href="#">Board</a></li>
                            <li><a href="#">Contact Us</a></li>
                        @else
                            <p class="navbar-text"><a href="{{ url('/members') }}">Members Area</a></p>
                            <li><a href="#">News</a></li>
                            <li><a href="#">Shipping Rates</a></li>
                            <li><a href="{{ url('/members/forums') }}">Forums</a></li>
                            <li><a href="#">Software</a></li>
                            <li><a href="#">Directory</a></li>
                        @endif

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><p class="navbar-btn"><a role="button" class="btn btn-primary" href="{{ url('/register') }}">Become a Member</a></p></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('users/'.Auth::user()->id.'/edit') }}">Your Profile</a></li>
                                    <li><a href="{{ url('subscriptions/'.Auth::user()->id.'/edit') }}">Your Subscription</a
                                    ></li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
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

        @yield('content')
    </div>
    <footer>

        <div class="container">
            <ul>
                <li>Copyright &copy; 2016. All rights reserved.</li>
                <li><a href="#">Terms of Use</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Site Map</a></li>
                <li class="pull-right">Hosting and Maintenance by QWYK</li>
            </ul>
        </div>

    </footer>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    @yield('js')
</body>
</html>
