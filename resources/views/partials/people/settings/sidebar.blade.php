<nav class="col-sm-4 col-md-3 d-none d-sm-block ml-0">
    <h5 class="text-muted"><strong>Personal Settings</strong></h5>
    <ul class="navbar-nav flex-column nav-sidebar">
        <li class="nav-item">
            <a class="nav-link @yield('sidebar_profile')" href="/people/settings/profile">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('sidebar_account')" href="/people/settings/account">Account</a>
        </li>
        @role('doctor')
            <li class="nav-item">
                <a class="nav-link @yield('sidebar_doctor_form')" href="/people/settings/profile/doctor">Profile Doctor</a>
            </li>
        @endrole
    </ul>
</nav>