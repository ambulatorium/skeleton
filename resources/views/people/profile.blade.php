@extends('layouts.master')

@section('title', Auth::user()->name)
@section('tab-people', 'active')

@section('content')

    @include('partials.people.tab')

    <div class="col-md-8 offset-md-2 mt-3">
        
        @include('partials.people.profile')

        <div class="list-group mt-2">
            @forelse($appointments as $appointment)
                <a href="/people/appointment/{{$appointment->id}}" class="list-group-item list-group-item-action">
                    <h5>{{ \Carbon\Carbon::parse($appointment->date)->format('l') }}
                        <small>
                            {{ \Carbon\Carbon::parse($appointment->date)->format('F Y') }} with
                            {{ $appointment->schedule->doctor->user->name }}
                        </small>
                    </h5>
                    <small>
                        Preferred Time
                        {{ \Carbon\Carbon::parse($appointment->preferred_time)->format('H:ia') }}
                    </small>
                </a>
            @empty
                <div class="list-group-item">
                    <h5 class="text-muted text-center"><strong>You don't have any appointment yet</strong></h5>
                    <h6 class="text-muted text-center">when you have an appointment, it'll show up here.</h6>
                </div>
            @endforelse
        </div>

        <div class="mt-3 text-center">
            <a href="/" class="btn btn-outline-secondary btn-sm">Schedule an appoinment</a>            
        </div>

    </div>

@endsection