@forelse ($schedules as $schedule)
    <div class="col-md-3 mt-4 text-dark">
        <div class="list-group">
            <div class="list-group-item flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">
                        {{ $schedule->day }}
                    </h5>
                </div>
                <div class="d-flex w-100 justify-content-between">
                    <p class="mb-1">
                        Working Hours
                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('g:ia') }} 
                                -
                        {{ \Carbon\Carbon::parse($schedule->end_time)->format('g:ia') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-md-12 text-center text-secondary mt-5">
        <h5>{{ $doctor->full_name }} does not have a schedule yet.</h5>
    </div>
@endforelse