<div class="page-header">
    <div class="container mt-3">
        <h4 class="text-uppercase"><strong>{{ $group->health_care_name }}</strong></h4>
        <h6>{{ $group->address }}, {{ $group->city }}, {{ $group->country }}.</h6>
    </div>
</div>

<div class="nav-scroller box-shadow-nav">
    <nav class="nav nav-pills container">
        <div class="nav-item">
            <a class="nav-link @yield('tab-doctors')" href="/{{ $group->slug }}">Doctors</a>
        </div>

        @can('update', $group)
            <div class="nav-item">
                <a class="nav-link @yield('tab-settings')" href="/{{ $group->slug }}/settings/profile">Settings</a>
            </div>
        @endcan
    </nav>
</div>