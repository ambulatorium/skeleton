<nav class="col-sm-3 col-md-2 d-none d-sm-block ml-0">
    <small><a href="/{{ $group->slug }}">< {{ $group->health_care_name }}</a></small>
    <h5 class="text-muted"><strong> Group Settings</strong></h5>
    <ul class="navbar-nav flex-column nav-sidebar">
        <li class="nav-item">
            <a class="nav-link @yield('sidebar_profile')" href="/{{ $group->slug }}/settings/profile">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('sidebar_staffs')" href="/{{ $group->slug }}/settings/staffs">Staffs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('sidebar_invitation')" href="/{{ $group->slug }}/settings/invitations">Invitations</a>
        </li>
    </ul>
</nav>