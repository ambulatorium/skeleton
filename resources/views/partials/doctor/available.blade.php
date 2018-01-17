<main class="col-md-12">

    <div class="card tbr-0">
        <div class="card-header">
            <h4 class="card-text">All Doctor</h4>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-rq">
                <thead class="thead-rq">
                    <tr>
                        <th>Name</th>
                        <th>Polyclinic/Speciality</th>
                        <th>Health Care Provider</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($doctors as $doctor)
                        <tr>
                            <td>
                                <img src="{{ asset('img/example-avatar.png') }}" alt="reliqui avatar" class="img-responsive" width="30">
                                {{ $doctor->full_name }}
                            </td>
                            <td>{{ $doctor->speciality->name }}</td>
                            <td>{{ $doctor->group->health_care_name }}</td>
                            @if ($doctor->is_active)
                                <td class="text-info font-weight-bold">Active</td>
                            @else
                                <td class="text-warning">Not Active</td>
                            @endif
                        </tr>
                    @empty
                        <tr><td class="text-muted">No doctor yet...</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $doctors->links('vendor.pagination.bootstrap-4') }}

</main>