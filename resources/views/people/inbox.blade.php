@extends('layouts.master')

@section('title', Auth::user()->name)
@section('dashboard-inbox', 'active')

@section('menu')
    @include('partials.master.menu.users.dashboard')
@endsection

@section('content')
    <main class="col-md-8 offset-md-2 my-3 p-3">
        <div class="list-group">
            @forelse($appointments as $appointment)
                <a href="/people/inbox/appointments/{{$appointment->token}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div class="media">
                        <img src="{{ asset('img/example-avatar.png') }}" alt="reliqui avatar" class="img-responsive mr-3" width="50" height="50">
                        <p class="media-body mb-0">
                            <strong class="d-block text-gray-dark">{{ $appointment->doctor->full_name }}</strong>
                            Physical appointment
                            {{ \Carbon\Carbon::parse($appointment->date)->format('l') }}
                            {{ \Carbon\Carbon::parse($appointment->date)->format('d F Y') }}
                            {{ \Carbon\Carbon::parse($appointment->preferred_time)->format('H:ia') }}
                        </p>
                    </div>
                    <div class="text-secondary">
                        {{ $appointment->created_at->diffForHumans() }}
                    </div>
                </a>
            @empty
                <div class="text-muted text-center">
                    <strong>You don't have doctor's appointment yet.</strong>
                    <p>when you have an appointment, it'll show up here</p>
                </div>
            @endforelse
        </div>

        <div class="mt-3 text-center">
            <a href="/" class="btn btn-outline-secondary btn-sm">Schedule an appoinment</a>
        </div>

    </main>
@endsection