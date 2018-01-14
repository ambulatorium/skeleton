@extends('layouts.master')

@section('title', Auth::user()->name)
@section('tab-health-history', 'active')

@section('content')

    @include('partials.people.tab')

    <div class="col-md-8 offset-md-2 mt-3">
        <div class="list-group">
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div class="text-secondary">
                    <img src="{{ asset('img/example-avatar.png') }}" class="img-responsive mr-2" width="28">
                    {{ $health_history->user->name }}
                </div>

                <div class="text-secondary">
                    {{ $health_history->created_at->diffForHumans() }}
                </div>
            </div>


            <div class="list-group-item bg-light">
                <h5 class="mt-5 mb-5 text-center text-secondary">
                    <strong class="text-uppercase">{{ $health_history->group->health_care_name }}</strong><p>
                    <small>
                        {{ $health_history->group->address }}, {{ $health_history->group->city }}, {{ $health_history->group->country }}.
                    </small>
                </h5>

                <div class="alert alert-danger bg-light">
                    <p>Diagnosis {{ $health_history->doctor->user->name }}</p><hr>
                    {{ $health_history->doctor_diagnosis }}
                </div>

                <div class="alert alert-success bg-light">
                    <p>Action {{ $health_history->doctor->user->name }}</p><hr>
                    {{ $health_history->doctor_action }}
                </div>

                <div class="alert alert-info bg-light">
                    <p>Note {{ $health_history->doctor->user->name }}</p><hr>

                    @if (! $health_history->doctor_note)
                        ... ... ...
                    @endif

                    {{ $health_history->doctor_note }}
                </div>
            </div>
        </div>
    </div>

@endsection