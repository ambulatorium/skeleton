@extends('layouts.master')

@section('title', 'Physical Appointment')

@section('content')
    <div class="container">    
        <div class="row">

            <div class="col-md-12">
                @include('partials.people.profile.patient')
            </div>

            <div class="col-md-4 offset-md-4 mt-3">
                <div class="list-group">
                    <div class="list-group-item text-center">
                        <h5>
                            {{ $appointment->schedule->doctor->user->name }},
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($appointment->date)->format('l') }},
                                {{ \Carbon\Carbon::parse($appointment->date)->format('d F Y') }}
                                {{ \Carbon\Carbon::parse($appointment->preferred_time)->format('H:ia') }}
                            </smal>
                        </h5>
                    </div>
                    <div class="list-group-item text-center">
                        <em>
                            "{{ $appointment->patient_condition }}""
                        </em>
                    </div>
                    <div class="list-group-item">
                        <h5><strong>
                            Rp{{ $appointment->schedule->estimated_price_service }}
                        </strong></h5>
                    </div>
                </div>

                <div class="mt-3">
                    <form action="/{{$group->slug}}/appointments/{{$appointment->token}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <button class="btn btn-sm btn-danger btn-block" type="submit">CONFIRM APPOINTMENT</button>
                        <a href="/{{$group->slug}}/appointments" class="btn btn-sm btn-secondary btn-block">CANCEL</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection