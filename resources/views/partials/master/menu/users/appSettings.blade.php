<div class="page-header">
    <div class="container text-center text-secondary">
        <strong>App Settings</strong>
    </div>
</div>

<div class="nav-scroller box-shadow-nav">
    <nav class="nav nav-pills container justify-content-md-center">
        @role('owner|administrator')
            <a class="nav-link @yield('setting-groups')" href="/settings/groups">Groups</a>
        
            @role('owner')
                <a class="nav-link @yield('setting-staffs')" href="/settings/staffs">Staffs</a>
            @endrole

            <a class="nav-link @yield('setting-specialities')" href="/settings/specialities">Specialities</a>
        @endrole
    </nav>
</div>