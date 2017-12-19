<ul class="nav nav-pills">
    <div class="container">
        <div class="row">
            <li class="nav-item">
                <a class="nav-link @yield('tab-people')" href="/people">Appointments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @yield('tab-health-history')" href="#">Health History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#makeAppointment">Make an appointment</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/people/settings/profile">Settings</a>
            </li>
            @role('owner|admin')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Manage</a>
                    <div class="dropdown-menu">
                        @role('owner')
                            <a class="dropdown-item" href="/settings/staffs">Staff Management</a>
                        @endrole
                        <a class="dropdown-item" href="/settings/groups">Health Care Provider</a>
                        <a class="dropdown-item" href="/settings/specialities">Polyclinics/Speciality</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/appointments">Appointments</a>
                        <a class="dropdown-item" href="/patients">Patients</a>
                        <a href="/doctors" class="dropdown-item">Doctors</a>
                        {{--  pending, useless feature  --}}
                        {{--  @can('view-counters')
                            <a class="dropdown-item" href="/counters">Counters</a>
                        @endcan  --}}
                    </div>
                </li>
            @endrole
        </div>
    </div>
</ul>

<div class="modal fade" id="makeAppointment" tabindex="-1" role="dialog" aria-labelledby="makeAppointmentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="makeAppointmentLabel">Make an Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/physical-appointment" method="get" class="form-horizontal">
                    <div class="form-group">
                        <select name="location" class="form-control" required>
                            <option value="">Select location...</option>
                            {{--  @foreach($locations as $location)
                                <option value="{{ $location->health_care_name }}"> {{ $location->health_care_name }}</option>
                            @endforeach  --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="polyclinic" class="form-control" required>
                            <option value="">Select Speciality...</option>
                            {{--  @foreach($specialities as $speciality)
                                <option value="{{ $speciality->name }}"> {{ $speciality->name }}</option>
                            @endforeach  --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="date" name="date" class="form-control" min="{{ Carbon\Carbon::tomorrow()->format('Y-m-d') }}" max="{{ Carbon\Carbon::tomorrow()->addDays(7)->format('Y-m-d') }}" required>
                    </div>

                    <button class="btn btn-secondary btn-block" type="submit">SEARCH</button>
                </form>
            </div>
        </div>
    </div>
</div>