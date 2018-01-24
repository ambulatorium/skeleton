@extends('layouts.master')

@section('title', Auth::user()->name)
@section('dashboard-inbox', 'active')

@section('menu')
    @include('partials.master.menu.dashboard')
@endsection

@section('content')
    <div class="col-md-8 offset-md-2 mt-4">
        <div class="list-group">
            <div class="list-group-item bg-secondary">
                <h5 class="text-white mb-0"><strong>Inbox</strong></h5>
            </div>

            @forelse($appointments as $appointment)
                <a href="/people/appointments/{{$appointment->token}}" class="list-group-item list-group-item-action">
                    <h5>{{ \Carbon\Carbon::parse($appointment->date)->format('l') }}
                        <small>
                            {{ \Carbon\Carbon::parse($appointment->date)->format('d F Y') }} with
                            {{ $appointment->doctor->full_name }}
                        </small>
                    </h5>
                    <small>
                        Preferred Time
                        {{ \Carbon\Carbon::parse($appointment->preferred_time)->format('H:ia') }}
                    </small>
                </a>
            @empty
                <div class="list-group-item">
                    <h5 class="text-muted text-center mt-2">
                        You don't have doctor's appointment yet.
                    </h5>
                    <h6 class="text-muted text-center">when you have an appointment, it'll show up here.</h6>
                </div>
            @endforelse
        </div>

        <div class="mt-3 text-center">
            <a href="/" class="btn btn-outline-secondary btn-sm">Schedule an appoinment</a>
        </div>

    </div>
@endsection