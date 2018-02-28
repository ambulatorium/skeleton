<div class="table-responsive">
    <table class="table table-hover table-rq box-shadow-table">
        <thead class="thead-rq">
            <tr>
                <th>Token</th>
                <th>Appointment Date</th>
                <th>Preffered Time</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $appointment)
                <tr>
                    <td class="text-uppercase">
                        <a href="/{{$group->slug}}/appointments/{{$appointment->token}}">
                            {{ $appointment->token }}
                        </a>
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($appointment->date)->format('l') }},
                        {{ \Carbon\Carbon::parse($appointment->date)->format('d F Y')}}.
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($appointment->preferred_time)->format('H:ia') }}
                    </td>
                </tr>
            @empty
            <tr>
                <td class="text-muted">...</td>
                <td class="text-muted">...</td>
                <td class="text-muted">...</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>