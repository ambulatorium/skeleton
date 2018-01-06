@forelse($schedules as $schedule)
    <div class="col-md-3 mt-3">
        <div class="list-group text-center">
            <div class="list-group-item">
                <div class="text-muted">
                    <h4>{{ $schedule->day }}</h4>
                </div>
                <small class="mb-1">
                    Working Hours
                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:ia') }} 
                            -
                    {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:ia') }}
                </small>
            </div>
        </div>
    </div>
@empty
    <div class="col-md-12 mt-5 text-center">
        <h5 class="text-muted"><strong>Sorry, doctor don't have any schedule yet</strong></h5>
    </div>
@endforelse