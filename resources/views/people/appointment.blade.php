@extends('layouts.master')

@section('title', Auth::user()->name)
@section('tab-people', 'active')

@section('content')

    <div class="col-md-8 offset-md-2 mt-5 text-center">

        <h1 class="mt-3">
            {{ \Carbon\Carbon::parse($appointment->date)->format('l') }}
            <p>{{ \Carbon\Carbon::parse($appointment->date)->format('d F Y') }}</p>
        </h1>

        <h5>
            <strong>
                Preferred Time {{ \Carbon\Carbon::parse($appointment->preferred_time)->format('H:ia') }}
                With {{ $appointment->schedule->doctor->user->name }}
            </strong>
        </h5>
        
        <h4 class="text-secondary">
            {{ $appointment->schedule->doctor->group->health_care_name }}, 
            {{ $appointment->schedule->doctor->group->address }},
            {{ $appointment->schedule->doctor->group->city }}.
        <h4>
        
        <div class="list-group mt-5">
            <div class="list-group-item bg-light">
                <small><em>{{ $appointment->patient_condition }}</em></small>
            </div>
        </div>

        <div class="mt-5">
            <a href="/people" class="btn btn-sm btn-outline-secondary">< back</a>            
        </div>
    </div>

@endsection