<nav class="col-sm-3 col-md-2 d-none d-sm-block sidebar ml-0 mt-3">
    <ul class="navbar-nav flex-column">
        <li class="nav-item">
            <h5 class="nav-link text-muted mb-0"><strong> Appointment </strong></h5>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('sidebar_appointments')" href="/appointments">All <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('sidebar_today')" href="/appointments/today">Today</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('sidebar_cancel')" href="/appointments/cancel">Cancel</a>
        </li>
    </ul>
</nav>