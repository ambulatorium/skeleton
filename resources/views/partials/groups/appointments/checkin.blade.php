<div class="col-md-4 offset-md-4 mt-3">
    <div class="list-group">
        <div class="list-group-item">
            <div class="text-center">
                <h4>
                    <small>meet with</small><p>
                    <strong>{{ $appointment->doctor->full_name }}</strong>
                </h4>
                
                <em>Physical Appointment</em>
            </div>

            <hr>

            <strong>Price</strong>
            <strong class="float-right">{{ $appointment->schedule->estimated_price_service }}</strong>
        </div>
    </div>

    <div class="mt-3">
        <form action="/{{$group->slug}}/appointments/{{$appointment->token}}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <button class="btn btn-sm btn-danger btn-block" type="submit">CHECKIN OUTPATIENTS</button>
            <a href="/{{$group->slug}}/appointments" class="btn btn-sm btn-secondary btn-block">CANCEL</a>
        </form>
    </div>
</div>