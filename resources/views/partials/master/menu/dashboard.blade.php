<div class="nav-scroller box-shadow">
    <nav class="nav nav-underline justify-content-md-center">
        <a class="nav-link @yield('dashboard-profile')" href="/people">Profile</a>
        @role('doctor')
            <a class="nav-link @yield('dashboard-appointments')" href="/people/doctor/appointments">Appointments</a>
            <a class="nav-link @yield('dashboard-schedules')" href="/people/schedules">Schedules</a>
        @endrole
        <a class="nav-link @yield('dashboard-health-history')" href="/people/health-history">Health history</a>
        
        @role('owner|administrator')
            <a class="nav-link" href="/settings/groups">Manage groups</a>
        @endrole
    </nav>
</div>