<div class="page-header">
    <div class="container">
        <h4><strong>{{ $group->health_care_name }}</strong></h4>
        <h6>{{ $group->address }}, {{ $group->city }}, {{ $group->country }}.</h6>
    </div>

    <div class="nav nav-pills">
        <div class="container">
            <div class="row">
                <div class="nav-item">
                    <a class="nav-link @yield('tab-doctors')" href="/{{ $group->slug }}">Doctors</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link @yield('tab-appointments')" href="/{{ $group->slug }}/appointments">Appointments</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link @yield('tab-settings')" href="/{{ $group->slug }}/settings/profile">Settings</a>
                </div>
            </div>
        </div>
    </div>
</div>