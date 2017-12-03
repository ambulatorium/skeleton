<div class="col-md-3 mb-1">
    <div class="card text-center">
        <div class="card-body">
            <h4 class="card-title">{{ $counter->name }}</h4>
            <p class="card-text">
                @if($counter->is_active)
                    <form action="/counters/{{ $counter->id }}" method="POST" class="">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <input type="hidden" name="is_active" value="0">

                        <button class="btn btn-sm btn-success" type="submit" data-toggle="tooltip" title="Inactive counters">Active</button>
                    </form>
                @else
                    <form action="/counters/{{ $counter->id }}" method="POST" class="">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <input type="hidden" name="is_active" value="1">

                        <button class="btn btn-sm btn-secondary" type="submit" data-toggle="tooltip" title="Active counters">Inactive</button>
                    </form>
                @endif
            </p>

            <small class="card-text text-muted">
                @if( $counter->is_booking )
                    <strong>Booking Counter</strong>
                @else
                    <strong>Registration Counter</strong>
                @endif
            </small><p>
            <small class="card-text text-muted">Last Changed {{ $counter->updated_at->format('d/m/Y g:i:s a') }}</small>
        </div>
    </div>
</div>