<div class="col-md-12">
    <h4><strong>{{ $doctor->name }}</strong></h4>
    <h6>{{ $doctor->bio }}</h6>
</div>

<div class="col-md-12 mt-2">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link @yield('tab-profile')" href="#">Appointments</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('tab-schedule')" href="#">Schedule</a>
        </li>
    </ul>
</div>