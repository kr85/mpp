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

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        @include('menus.main.top')

        <div class="container">

            @if (Session::has('success'))
                {{ Session::get('success') }}
            @endif

            @yield('content')

        </div>

        @include('footers.main.footer')

        <!-- JavaScript -->
        {{ HTML::script('assets/javascript/frontend.js') }}

        @yield('assets')

    </body>
</html>