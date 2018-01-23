@extends('layouts.master') 

@section('title', Auth::user()->name) 

@section('content')
    <div class="col-md-8 offset-md-2 text-center mt-4 mb-4">
        <h1 class="mt-3">
            {{ \Carbon\Carbon::parse($appointment->date)->format('l') }}
            <p>{{ \Carbon\Carbon::parse($appointment->date)->format('d F Y') }}</p>
        </h1>

        <h5>
            <strong>
                Preferred Time {{ \Carbon\Carbon::parse($appointment->preferred_time)->format('H:ia') }}
                with {{ $appointment->doctor->full_name }}
            </strong>
        </h5>

        <h4 class="text-secondary">
            show this token <span class="badge badge-info text-uppercase">{{ $appointment->token }}</span> when visiting
            <p>{{ $appointment->doctor->group->health_care_name }}, {{ $appointment->doctor->group->address }}, {{ $appointment->doctor->group->city}}.
        </h4>

        <div class="list-group mt-5">
            <div class="list-group-item bg-light">
                <em>{{ $appointment->patient_condition }}</em>
            </div>
        </div>

        <div class="mt-5">
            <a href="/people" class="btn btn-sm btn-outline-secondary">< back</a>
        </div>
    </div>
@endsection