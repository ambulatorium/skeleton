<div class="col-md-12 mt-3">
    <h4><strong>{{ $group->health_care_name }}</strong></h4>
    <h6>{{ $group->country }} - {{ $group->city }} - {{ $group->address }}</h6>
    {{--  <h6 class="text-muted">Min Appointment {{ $group->min_day_appointment }} day - Max Appointment {{ $group->max_day_appointment }} day</h6>  --}}
</div>

<div class="col-md-12 mt-3">
    <ul class="nav nav-rills">
        <li class="nav-item">
            <a class="nav-link @yield('tab-doctors')" href="#">Doctors</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('tab-settings')" href="#">Settings</a>
        </li>
    </ul>
</div>