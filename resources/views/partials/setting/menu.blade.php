<nav class="col-sm-3 col-md-2 d-none d-sm-block sidebar ml-0 mt-3">
    <ul class="navbar-nav flex-column">
        <li class="nav-item">
            <h5 class="nav-link text-muted mb-0"><strong> Settings </strong></h5>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('sidebar_group')" href="/settings/groups">Group</a>
        </li>
        @can('view-staffs')
            <li class="nav-item">
                <a class="nav-link @yield('menu_staffs')" href="/settings/staffs">Staff Management</a>
            </li>
        @endcan
    </ul>
</nav>