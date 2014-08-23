<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="A place where you can track your physical performance,
                log your training workouts, read cool blogs.">
        <meta name="author" content="Kosta Rashev">
        <title>Maximal Physical Performance</title>

        <!-- Bootstrap -->
        {{ HTML::style('assets/stylesheets/frontend.css') }}

        <!-- Custom CSS -->
        {{ HTML::style('assets/stylesheets/custom.css') }}

        <!-- FontAwesome -->
        {{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css') }}

        <!-- jQuery Vegas CSS -->
        {{-- HTML::style('../bower_components/libs/vegas/jquery.vegas.css') --}}

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="animated_bg">
        @include('menus.main.top')

        @if(Route::currentRouteName() == 'index')
        <div class="section-intro">
            <div class="intro-button-group">
                @if(!Sentry::check())
                <a href="{{ URL::route('sessions.login') }}" class="intro-button">
                    LOGIN
                </a>
                <a href="{{ URL::route('register.index') }}" class="intro-button">
                    REGISTER
                </a>
                @else
                <a href="{{ URL::route('sessions.logout') }}" class="intro-button">
                    LOGOUT
                </a>
                @endif
            </div>
            <div class="intro-section-arrow">
            </div>
        </div>
        @endif

        <div class="container container-color fill">
            <div class="clear-fix"></div>
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-warning" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif

            @yield('content')

        </div>

        <!--@include('footers.main.footer')-->

        <!-- JavaScript -->
        {{ HTML::script('assets/javascript/frontend.js') }}
        {{ HTML::script('../routes.js') }}
        {{ HTML::script('assets/javascript/custom.js') }}

        @yield('assets')
    </body>
</html>