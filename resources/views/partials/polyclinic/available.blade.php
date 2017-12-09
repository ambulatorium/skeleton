<main class="col-md-12">

    <div class="card mb-3">
        <div class="card-header">
            <a href="/polyclinics/create" class="btn btn-outline-danger btn-sm float-right">Add Polyclinic</a>
            <h4 class="card-text">Polyclinic/Speciality List</h4>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-rq">
                <thead class="thead-rq">
                    <tr>
                        <th>Name</th>
                        <th>Service Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($polyclinics as $polyclinic)
                        <tr>
                            <td><a href="/polyclinics/{{ $polyclinic->id }}">{{ $polyclinic->name }}</a></td>
                            <td>{{ $polyclinic->service_description }}</td>
                        </tr>
                    @empty
                        <tr><td class="text-muted">No polyclinic/speciality yet...</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $polyclinics->links('vendor.pagination.bootstrap-4') }}

</main>