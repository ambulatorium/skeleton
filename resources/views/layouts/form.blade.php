<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('partials.master.head')

<body class="pt-0">
    <div id="app">
        <nav class="navbar navbar-expand-sm navbar-form navbar-light">
            <div class="container">

                <a href="/" class="navbar-brand">
                    <img src="{{ asset('img/reliqui-heart.png') }}" alt="reliqui" class="img-responsive" height="50">
                </a>

                <div>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle active" id="navbarMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('img/example-avatar.png') }}" alt="{{ Auth::user()->name }}" class="img-responsive rounded" height="30" width="30">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarMenu">
                                <h6 class="dropdown-header"><strong>{{ Auth::user()->name }}</strong></h6>
                                <a href="/user/inbox" class="dropdown-item">Inbox</a>
                                <a href="/user/settings/account" class="dropdown-item">Settings</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Sign Out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
                
            </div>
        </nav>

        @yield('form')

    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>