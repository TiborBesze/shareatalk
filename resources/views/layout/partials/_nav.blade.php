<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a href="{{ route('home') }}" class="navbar-brand">Share-A-Talk</a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            @auth
            <ul class="nav navbar-nav">
                <li><a href="{{ route('talk.create') }}">Share</a></li>
            </ul>
            @endauth
            <ul class="nav navbar-nav navbar-right">
                @auth
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Your Account <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('auth.login.destroy') }}" id="logout">Logout</a>

                                <form id="logout-form" action="{{ route('user.logout') }}" class="hidden" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ route('auth.login.create') }}">Login</a></li>
                    <li><a href="{{ route('auth.register.create') }}">Register</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
