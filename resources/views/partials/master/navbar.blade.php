<div class="collapse navbar-collapse" id="navbarMenu">

    {{--  @todo search doctor, healthcare provider  --}}
    <ul class="navbar-nav mr-auto">
        <form action="#" method="#" class="form-inline">
            <div class="input-group">
                <input class="search-input" type="search" name="query" placeholder="search...">
            </div>
        </form>
    </ul>

    <ul class="navbar-nav my-2 my-lg-0">
        @guest
            <li class="nav-item">
                <a href="/login" class="nav-link active"><strong>My Account</strong></a>
            </li>
        @else
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle active" id="navbarMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <strong>{{ Auth::user()->name }}</strong>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarMenu">
                    <a href="/people" class="dropdown-item">My Profile</a>
                    <a href="/people/settings/account" class="dropdown-item">My Account Settings</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Log Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        @endguest
    </ul>

</div>