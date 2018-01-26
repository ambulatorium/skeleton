@extends('layouts.master')

@section('title', Auth::user()->name)

@section('content')
    <main class="col-md-8 offset-md-2 my-3 p-3">
        <div class="list-group">
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div class="text-secondary">
                    <img src="{{ asset('img/example-avatar.png') }}" class="img-responsive mr-2" width="28">
                    {{ $health_history->patient->full_name }}
                </div>

                <div class="text-secondary">
                    {{ $health_history->created_at->diffForHumans() }}
                </div>
            </div>


            <div class="list-group-item bg-light">
                <h5 class="mt-4 mb-5 text-center text-secondary">
                    <strong class="text-uppercase">{{ $health_history->group->health_care_name }}</strong><p>
                    <small>
                        {{ $health_history->group->address }}, {{ $health_history->group->city }}, {{ $health_history->group->country }}.
                    </small>
                </h5>

                <div class="alert alert-danger bg-light">
                    <strong>Diagnosis by {{ $health_history->doctor->full_name }}</strong>
                    <hr>
                    {{ $health_history->doctor_diagnosis }}
                </div>

                <div class="alert alert-success bg-light">
                    <strong>Action by {{ $health_history->doctor->full_name }}</strong>
                    <hr>
                    {{ $health_history->doctor_action }}
                </div>

                <div class="alert alert-info bg-light">
                    <strong>Note by {{ $health_history->doctor->full_name }}</strong>
                    <hr>

                    @if (! $health_history->doctor_note)
                        ... ... ...
                    @endif

                    {{ $health_history->doctor_note }}
                </div>
            </div>
        </div>
    </main>
@endsection