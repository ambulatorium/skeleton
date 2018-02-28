<div class="page-header">
    <div class="container text-center">
        <a href="/{{ $group->slug }}" class="text-secondary text-uppercase">
            <strong>{{ $group->name }}</strong>
        </a>
    </div>
</div>

<div class="nav-scroller box-shadow-nav">
    <nav class="nav nav-pills container justify-content-md-center">
        <a class="nav-link @yield('appointments')" href="/{{ $group->slug }}/appointments">Outpatients Appointments</a>
    </nav>
</div>