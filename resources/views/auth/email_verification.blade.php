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
    <div class="container">
        <center>
            <img src="/res/logo-2.png" style="width: 50%">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Email Verification</h3>
                </div>
                <div class="panel-body">
                    <p>{!! $o['message'] !!}</p>

                    @if($o['action'] == 'login')
                    <a href="/login" class="btn btn-primary btn-lg btn-sqr">Continue to Log In</a>
                    @endif
                    @if($o['action'] == 'resend')
                    <br>
                    <h3>Resend Verification Email</h3>
                    <p>Fill your email address below to resend the verification email and try again.</p>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/member/verify/resend') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            

                            <div class="col-md-6 col-md-offset-3">
                                <input id="email" type="email" class="form-control" name="email" placeholder="Email Address" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('recaptcha') ? ' has-error' : '' }}">
                            <center>
                                <div id="recaptcha" name="recaptcha" class="g-recaptcha" data-sitekey="6LdYnQoUAAAAAFW6eqyIixhyQbOWxHQmHQM_vjzH"></div>
                                @if ($errors->has('recaptcha'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('recaptcha') }}</strong>
                                </span>
                                @endif
                            <center>
                        </div>
                         <div class="form-group">
                            <div >
                                <button type="submit" class="btn btn-primary btn-lg btn-sqr">
                                    Resend Verification Email
                                </button>

                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </center>
        
    </div>
</body>
<script src='https://www.google.com/recaptcha/api.js'></script>