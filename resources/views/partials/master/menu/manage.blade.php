<div class="nav-scroller box-shadow-nav">
    <nav class="nav nav-underline justify-content-md-center">
        @role('owner|administrator')
            <a class="nav-link @yield('manage-groups')" href="/settings/groups">Groups</a>

            @role('owner')
                <a class="nav-link @yield('manage-staffs')" href="/settings/staffs">Staffs</a>
            @endrole

            <a class="nav-link @yield('manage-specialities')" href="/settings/specialities">Specialities</a>
        @endrole
    </nav>
</div>