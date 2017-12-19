@extends('layouts.master')

@section('title', Auth::user()->name)
@section('tab-people', 'active')

@section('content')

    @include('partials.people.tab')

    <div class="container">
        <div class="row">
            
            {{--  @include('partials.people.tab')  --}}

            <div class="col-md-12 mt-5">
                @forelse($appointments as $appointment)
                    <h5 class="mb-1">{{ \Carbon\Carbon::parse($appointment->date_of_visit)->format('l, d F Y') }}
                        <small><span class="badge badge-info"><em>{{ $appointment->status }}</em></span></small>
                    </h5>
                    <p class="text-muted">
                        {{ $appointment->doctor->group->health_care_name }} - Preferred Time {{ $appointment->preferred_time }}
                    </p>
                    <strong>
                        {{ $appointment->doctor->name }} - {{ $appointment->doctor->speciality->name }}
                    </strong>
                    <form action="/appointments/cancel/{{ $appointment->id }}" method="POST" class="float-right">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <button type="submit" class="btn btn-sm btn-danger"> Cancel</button>
                    </form>
                    <hr>
                @empty
                    <h5 class="text-muted text-center"><strong>You don't have any appointment yet</strong></h5>
                    <h6 class="text-muted text-center">when you make an appointment, it'll show up here.</h6>
                @endforelse
            </div>

        </div>
    </div>
@endsection