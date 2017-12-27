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
                        <th>Gender</th>
                        <th>Polyclinic/Speciality</th>
                        <th>Health Care Provider</th>
                        <th>Price of Service</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($doctors as $doctor)
                        <tr>
                            <td>{{ $doctor->user->name }}</td>
                            <td>{{ $doctor->gender }}</td>
                            <td>{{ $doctor->speciality->name }}</td>
                            <td>{{ $doctor->group->health_care_name }}</td>
                            <td>{{ $doctor->price_of_service }}</td>
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