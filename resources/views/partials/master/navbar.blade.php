<div class="navbar-collapse offcanvas-collapse" id="navbarMenu">

    {{--  @todo search doctor, healthcare provider  --}}
    <form action="#" method="#" class="form-inline mr-auto">
        <div class="input-group">
            <input class="search-input" type="search" name="query" placeholder="search...">
        </div>
    </form>

    <ul class="navbar-nav my-2 my-lg-0">
        <li class="nav-item">
            <a href="/explore" class="nav-link @yield('explore')">Explore</a>
        </li>
        @guest
            <li class="nav-item">
                <a href="/login" class="nav-link">My Account</a>
            </li>
        @else
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle active" id="navbarMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('img/example-avatar.png') }}" alt="{{ Auth::user()->name }}" class="img-responsive rounded" height="25" width="25">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarMenu">
                    <h6 class="dropdown-header"><strong>{{ Auth::user()->name }}</strong></h6>
                    <a href="/people/inbox" class="dropdown-item">Inbox</a>
                    <a href="/people/settings/account" class="dropdown-item">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Sign Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        @endguest
    </ul>

</div>