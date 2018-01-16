<ul class="nav nav-pills justify-content-center">
    <li class="nav-item">
        <a class="nav-link @yield('tab-people')" href="/people">Profile</a>
    </li>
    @role('doctor')
        <li class="nav-item">
            <a class="nav-link @yield('tab-appointments')" href="/people/doctor/appointments">Appointments</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('tab-schedule')" href="/people/schedules">Schedules</a>
        </li>
    @endrole
    <li class="nav-item">
        <a class="nav-link @yield('tab-health-history')" href="/people/health-history">Health History</a>
    </li>
    @role('owner|admin')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Manage</a>
            <div class="dropdown-menu">
                @role('owner')
                    <a class="dropdown-item" href="/settings/staffs">Staff Management</a>
                @endrole
                <a class="dropdown-item" href="/settings/groups">Health Care Provider</a>
                <a class="dropdown-item" href="/settings/specialities">Polyclinics/Speciality</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/appointments">Appointments</a>
                <a href="/doctors" class="dropdown-item">Doctors</a>
            </div>
        </li>
    @endrole
</ul>