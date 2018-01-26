<div class="page-header">
    <div class="container text-secondary">
        <strong class="text-capitalize">{{ Auth::user()->name }}</strong>

        @role('admin-group|admin-counter')
            <div class="float-right dropdown">
                <a href="#" class="dropdown-toggle btn btn-sm btn-outline-secondary" id="navbarMenuGroup" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <strong>Group</strong>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarMenuGroup">
                    <h6 class="dropdown-header"><strong>{{ Auth::user()->staff->group->health_care_name }}</strong></h6>
                    <a href="/{{Auth::user()->staff->group->slug}}/appointments" class="dropdown-item">Appointments</a>
                    
                    @role('admin-group')
                        <a href="/{{Auth::user()->staff->group->slug}}/settings/profile" class="dropdown-item">Settings</a>
                    @endrole
                </div>
            </div>
        @endrole
        
    </div>
</div>

<div class="nav-scroller box-shadow-nav">
    <nav class="nav nav-pills container">
        <a class="nav-link @yield('dashboard-inbox')" href="/people">Inbox</a>
        <a class="nav-link @yield('dashboard-health-history')" href="/people/health-history">Health history</a>

        @role('doctor')
            <a class="nav-link @yield('dashboard-outpatients')" href="/people/outpatients">Outpatients</a>
            <a class="nav-link @yield('dashboard-schedules')" href="/people/schedules">Schedules</a> 
        @endrole

         @role('owner|administrator')
            <a class="nav-link" href="/settings/groups">App settings</a>
        @endrole
    </nav>
</div>