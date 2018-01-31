<div class="page-header">
    <div class="container text-center">
        <a href="/{{ $group->slug }}" class="text-secondary text-uppercase">
            <strong>{{ $group->health_care_name }}</strong>
        </a>
    </div>
</div>

<div class="nav-scroller box-shadow-nav">
    <nav class="nav nav-pills container justify-content-md-center">
        <a class="nav-link @yield('appointment-all')" href="/{{ $group->slug }}/appointments">All Outpatients Appointment</a>
    </nav>
</div>