@extends('layouts.master')

@section('title', Auth::user()->name)
@section('tab-people', 'active')

@section('content')
    @include('partials.people.tab')

    <div class="col-md-8 offset-md-2 col-sm-12 mt-4">
        @forelse($appointments as $appointment)
            <h5 class="mb-1">{{ \Carbon\Carbon::parse($appointment->date_of_visit)->format('l, d F Y') }}
                <small><span class="badge badge-info"><em>{{ $appointment->status }}</em></span></small>
            </h5>
            <p class="text-muted">
                {{ $appointment->doctor->group->health_care_name }} - {{ $appointment->preferred_time }}
            </p>
            <strong>
                {{ $appointment->doctor->name }} - {{ $appointment->doctor->polyclinic->name }}
            </strong>
            <form action="/appointments/cancel/{{ $appointment->id }}" method="POST" class="float-right">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <button type="submit" class="btn btn-sm btn-danger"> Cancel</button>
            </form>
            <hr>
        @empty
            <h4 class="text-muted text-center"><strong>You don't have any appointment yet</strong></h4>
            <h6 class="text-muted text-center">when you make an appointment, it'll show up here.</h6>
        @endforelse
    </div>
@endsection