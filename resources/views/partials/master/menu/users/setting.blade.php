<div class="page-header">
    <div class="container text-center text-secondary">
        <strong>Personal Settings</strong>
    </div>
</div>
<div class="nav-scroller box-shadow-nav">
    <nav class="nav nav-pills container justify-content-md-center">
        <a class="nav-link @yield('setting-account')" href="/user/settings/account">Account</a>
        <a class="nav-link @yield('setting-patients')" href="/user/settings/patient-form">Patient form</a>
        
        @role('doctor')
            <a class="nav-link @yield('setting-doctor-form')" href="/user/settings/profile/doctor">Profile Doctor</a>
        @endrole
    </nav>
</div>