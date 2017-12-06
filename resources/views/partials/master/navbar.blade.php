<div class="collapse navbar-collapse" id="navbarMenu">

    <ul class="navbar-nav mr-auto">
        @can('view-appointments')
            <li class="nav-item">
                <a href="/appointments" class="nav-link @yield('appointments')">Appointments</a>
            </li>
        @endcan
        @can('view-patients')
            <li class="nav-item">
                <a href="/patients" class="nav-link @yield('patients')">Patients</a>
            </li>
        @endcan
        @can('view-doctors')
            <li class="nav-item">
                <a href="/doctors" class="nav-link @yield('doctors')">Doctors</a>
            </li>
        @endcan
        @can('view-polyclinics')
            <li class="nav-item">
                <a href="/polyclinics" class="nav-link @yield('polyclinics')">Polyclinics</a>
            </li>
        @endcan
        {{--  pending, useless feature  --}}
        {{--  @can('view-counters')
            <li class="nav-item">
                <a href="/counters" class="nav-link @yield('counters')">Counters</a>
            </li>
        @endcan  --}}
        @can('view-settings')
            <li class="nav-item">
                <a href="/settings" class="nav-link @yield('settings')">Settings</a>
            </li>
        @endcan
    </ul>

    <ul class="navbar-nav my-2 my-lg-0">
        @guest
            <li class="nav-item">
                <a href="/login" class="nav-link">My Account</a>
            </li>
        @else
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle active" id="navbarMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarMenu">
                    <a href="/people/profile" class="dropdown-item">My Profile</a>
                    <a href="/people/account" class="dropdown-item">My Account Settings</a>
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