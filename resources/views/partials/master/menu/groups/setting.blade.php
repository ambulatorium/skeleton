<div class="page-header">
    <div class="container text-center">
        <a href="/{{ $group->slug }}" class="text-secondary text-uppercase">
            <strong>{{ $group->name }}</strong>
        </a>
        <small class="text-muted">settings</small>
    </div>
</div>

<div class="nav-scroller box-shadow-nav">
    <nav class="nav nav-pills container justify-content-md-center">
        <a class="nav-link @yield('group-profile')" href="/{{ $group->slug }}/settings/profile">Profile</a>
        <a class="nav-link @yield('group-staffs')" href="/{{ $group->slug }}/settings/staffs">Staffs</a>
        <a class="nav-link @yield('group-invitations')" href="/{{ $group->slug }}/settings/invitations">Invitations</a>
    </nav>
</div>