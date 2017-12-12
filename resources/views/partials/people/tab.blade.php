<div class="col-md-4">
    <div class="list-group">
        <div class="list-group-item text-center">
            <h5 class="mt-3">
                <strong>{{ Auth::user()->name }}</strong>
                <p class="text-muted"><small>{{ Auth::user()->email }}</small></p>
            </h5>
        </div>
        <a href="/people/profile" class="list-group-item list-group-item-action @yield('tab-profile')">
            Profile
        </a>
        <a href="/people/appointments" class="list-group-item list-group-item-action @yield('tab-appointments')">
            Appointments
        </a>
        <a href="/people/medical-record" class="list-group-item list-group-item-action @yield('tab-medical-record')">
            Medical Record
        </a>
        <a href="/people/account" class="list-group-item list-group-item-action @yield('tab-account')">
            Account Setting
        </a>
    </div>
</div>