<nav class="col-sm-3 col-md-2 d-none d-sm-block ml-0 mt-3">
    <h5 class="text-muted"><strong> Site Settings</strong></h5>
    <ul class="navbar-nav flex-column nav-sidebar">
        @role('owner|administrator')
            <li class="nav-item">
                <a class="nav-link @yield('sidebar_group')" href="/settings/groups">Groups</a>
            </li>
            
            @role('owner')
                <li class="nav-item">
                    <a class="nav-link @yield('menu_staffs')" href="/settings/staffs">Staffs</a>
                </li>
            @endrole

            <li class="nav-item">
                <a class="nav-link @yield('sidebar_specialities')" href="/settings/specialities">Specialities</a>
            </li>
        @endrole
    </ul>
</nav>