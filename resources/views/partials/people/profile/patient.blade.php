<div class="list-group">
    <div class="list-group-item">
        <a class="float-right btn btn-sm btn-outline-info" data-toggle="collapse" href="#expand-bio" aria-expanded="false" aria-controls="expand-bio">Expand</a>
        <strong>{{ $appointment->patient->full_name }}</strong>
        <p>
            {{ $appointment->patient->address }}, {{ $appointment->patient->city }}, 
            {{ $appointment->patient->state }}, {{ $appointment->patient->zip_code }}.
        </p>

        <div class="collapse mt-3" id="expand-bio">
            <div class="alert alert-info bg-light">
                <ul>
                    <li>
                        <strong>home phone:</strong> {{ $appointment->patient->home_phone }}
                    </li>
                    <li>
                        <strong>cell phone:</strong> {{ $appointment->patient->cell_phone }}
                    </li>
                    <li>
                        <strong>marital status:</strong> {{ $appointment->patient->marital_status }}
                    </li>
                </ul>
            </div>
        </div>
    </div>  
</div>