<div class="col-md-3">
    <div class="list-group">
        <div class="list-group-item">
            <strong class="mt-2">
                Personal Settings
            </strong>
        </div>
        <a href="/people/settings/profile" class="list-group-item list-group-item-action @yield('tab-profile')">
            Profile
        </a>
        @role('doctor')
            <a href="/people/settings/profile/doctor" class="list-group-item list-group-item-action @yield('tab-doctor')">
                Profile Doctor
            </a>
        @endrole
        <a href="/people/settings/account" class="list-group-item list-group-item-action @yield('tab-account')">
            Account Setting
        </a>
    </div>
</div>