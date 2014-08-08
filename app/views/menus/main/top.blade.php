<!-- Fixed navigation bar -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">MPP</a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav" id="nav-header-margin">
                <li><a href="#home">HOME</a></li>
                <li><a href="#blog">BLOG</a></li>
                <li><a href="#forum">FORUM</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        HELP <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>{{ HTML::link('/qa', 'Q/A') }}</li>
                        <li>{{ HTML::link('', 'CONTACT') }}</li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (!Sentry::check())
                    <li>{{ HTML::link('/register', 'REGISTER') }}</li>
                    <li>{{ HTML::link('/login', 'LOGIN') }}</li>
                @else
                    <li>{{ HTML::linkRoute('user.show', 'PROFILE', Sentry::getUser()->id) }}</li>
                    <li>{{ HTML::link('/logout', 'LOGOUT') }}</li>
                @endif
            </ul>
        </div>
    </div>
</nav>