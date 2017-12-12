<div class="col-md-8 offset-md-2 col-sm-12 mt-5">
    <h4><strong>{{ Auth::user()->name }}</strong></h4>
    <h6>{{ Auth::user()->email }}</h6>
</div>

<div class="col-md-8 offset-md-2 col-sm-12 mt-5">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link @yield('tab-people')" href="/people">Appointments</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('tab-health-history')" href="#">Health History</a>
        </li>
        @can('view-settings')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Manage</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/settings/groups">Health Care Provider</a>
                    <a class="dropdown-item" href="/polyclinics">Polyclinics/Speciality</a>
                </div>
            </li>
        @endcan
    </ul>
</div>