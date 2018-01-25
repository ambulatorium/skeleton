<div class="nav-scroller box-shadow-nav">
    <nav class="nav nav-underline justify-content-md-center">
        <a class="nav-link" href="/{{ $group->slug }}">Group</a>
        <a class="nav-link @yield('group-profile')" href="/{{ $group->slug }}/settings/profile">Profile</a>
        <a class="nav-link @yield('group-staffs')" href="/{{ $group->slug }}/settings/staffs">Staffs</a>
        <a class="nav-link @yield('group-invitations')" href="/{{ $group->slug }}/settings/invitations">Invitations</a>
    </nav>
</div>