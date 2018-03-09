{{--  <div class="container row justify-content-md-center">  --}}

<div class="col-md-4 mt-5">
    <div class="list-group">
        <div class="list-group-item">
            <div class="media">
                <img src="{{ asset('img/example-avatar.png') }}" alt="avatar" class="img-responsive mr-2" width="50" height="50">                    
                <p class="media-body mb-0">
                    <a class="d-block font-weight-bold">
                        {{ $appointment->patient->full_name }}
                    </a>
                    <a class="text-secondary font-weight-light">
                        verified
                    </a>
                </p>
            </div>
        </div>
    </div>

    <div class="list-group">
        <div class="list-group-item">
            <div class="media">
                <img src="{{ asset('img/example-avatar.png') }}" alt="avatar" class="img-responsive mr-2" width="50" height="50">                    
                <p class="media-body mb-0">
                    <a class="d-block font-weight-bold">
                        {{ $appointment->doctor->full_name }}
                    </a>
                    <a class="text-secondary font-weight-light">
                        {{ $appointment->doctor->speciality->name }}
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 mt-5">
    <div class="list-group">
        <div class="list-group-item">
            <div class="border-bottom mb-2">
                <strong>Physical Appointment</strong>
                <p>
                    {{ \Carbon\Carbon::parse($appointment->date)->format('l') }},
                    {{ \Carbon\Carbon::parse($appointment->date)->format('d F Y') }},
                    {{ \Carbon\Carbon::parse($appointment->preferred_time)->format('h:i a')}}.
                </p>
            </div>

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

{{--  </div>  --}}