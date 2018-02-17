@extends('layouts.master')

@section('title', Auth::user()->name)

@section('content')
    <main class="col-md-8 offset-md-2 my-3 p-3">
        <div class="list-group">
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div class="text-secondary">
                    <img src="{{ asset('img/example-avatar.png') }}" class="img-responsive mr-2" width="28">
                    {{ $healthHistory->patient->full_name }}
                </div>

                <div class="text-secondary">
                    {{ $healthHistory->created_at->diffForHumans() }}
                </div>
            </div>


            <div class="list-group-item bg-light">
                <h5 class="mt-4 mb-5 text-center text-secondary">
                    <strong class="text-uppercase">{{ $healthHistory->group->name }}</strong><p>
                    <small>
                        {{ $healthHistory->group->address }}, {{ $healthHistory->group->city }}, {{ $healthHistory->group->country }}.
                    </small>
                </h5>

                <div class="alert alert-danger bg-light">
                    <strong>Diagnosis by {{ $healthHistory->doctor->full_name }}</strong>
                    <hr>
                    {{ $healthHistory->doctor_diagnosis }}
                </div>

                <div class="alert alert-success bg-light">
                    <strong>Action by {{ $healthHistory->doctor->full_name }}</strong>
                    <hr>
                    {{ $healthHistory->doctor_action }}
                </div>

                <div class="alert alert-info bg-light">
                    <strong>Note by {{ $healthHistory->doctor->full_name }}</strong>
                    <hr>

                    @if (! $healthHistory->doctor_note)
                        ... ... ...
                    @endif

                    {{ $healthHistory->doctor_note }}
                </div>
            </div>
        </div>
    </main>
@endsection