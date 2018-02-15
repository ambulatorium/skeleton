@forelse($schedules as $schedule)
    <div class="col-md-6 mt-4">
        <div class="list-group">
            <a href="/scheduling/physical-appointment/{{$schedule->token}}?date={{request('date')}}" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">
                        {{ $schedule->doctor->full_name }}
                    </h5>
                    <p class="text-muted">
                        {{ $schedule->estimated_price_service }}
                    </p>
                </div>
                <div class="d-flex w-100 justify-content-between">
                    <p class="mb-1">
                        Working Hours
                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('g:ia') }} 
                                -
                        {{ \Carbon\Carbon::parse($schedule->end_time)->format('g:ia') }}
                    </p>
                </div>
                <small>A physical appointment is for treatment and consultation.</small>
            </a>
        </div>
    </div>
@empty
    <div class="col-md-12 mt-4">
        <ul class="list-group">
            <li class="list-group-item text-center">
                <strong class="text-muted">Sorry, The schedule you selected not available.</strong>
            </li>
        </ul>
    </div>
@endforelse