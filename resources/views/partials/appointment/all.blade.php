<main class="col-md-12">

    <div class="card tbr-0">
        <div class="card-header">
            <h4 class="card-text">All Appointment</h4>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-rq">
                <thead class="thead-rq">
                    <tr>
                        <th>Patient Name</th>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Preferred Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->patient->full_name }}</td>
                            <td>{{ $appointment->doctor->full_name }}</td>
                            <td>{{ $appointment->date }}</td>
                            <td>{{ $appointment->preferred_time }}</td>
                            <td>{{ $appointment->status }}</td>
                        </tr>
                    @empty
                        <tr><td class="text-muted">No appointment yet...</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $appointments->links('vendor.pagination.bootstrap-4') }}

</main>