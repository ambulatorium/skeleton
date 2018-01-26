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
                <a href="/people/appointments/{{$appointment->token}}" class="list-group-item list-group-item-action">
                    {{ \Carbon\Carbon::parse($appointment->date)->format('l') }}
                    {{ \Carbon\Carbon::parse($appointment->date)->format('d F Y') }} with

                    {{ $appointment->doctor->full_name }}
                    Preferred Time
                    {{ \Carbon\Carbon::parse($appointment->preferred_time)->format('H:ia') }}
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