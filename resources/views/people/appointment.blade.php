@extends('layouts.master')

@section('title', 'People - Appointments')
@section('tab-appointments', 'active')

@section('content')
<div class="container">
    <div class="row">

        @include('partials.people.tab')

        <div class="list-group col-md-8">

            <div class="list-group-item">
                <strong>Appointments</strong>
            </div>

            @forelse($appointments as $appointment)
                <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ \Carbon\Carbon::parse($appointment->date_of_visit)->format('l, d F Y') }} - <small>{{ $appointment->preferred_time }}</small></h5>
                        <p class="text-muted"><em>{{ $appointment->status }}</em></p>
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                        <p class="mb-1 text-muted">
                            <strong>
                                {{ $appointment->doctor->name }} - {{ $appointment->doctor->polyclinic->name }}
                            </strong>
                        </p>
                        <form action="/appointments/cancel/{{ $appointment->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <button type="submit" class="btn btn-sm btn-danger"> Cancel</button>
                        </form>
                    </div>
                    {{--  <small>You can pay the service charge at the counter.</small>  --}}
                </div>
            @empty
                <div href="#" class="list-group-item">
                    <h5 class="text-muted text-center mt-3"><strong>You don’t have any appointment yet</strong></h5>
                    <h6 class="text-muted text-center">when you make appointment, it'll show up here.</h6>
                </div>
            @endforelse

        </div>

    </div>
</div>

@endsection