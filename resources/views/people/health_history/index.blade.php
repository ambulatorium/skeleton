@extends('layouts.master')

@section('title', Auth::user()->name)
@section('dashboard-health-history', 'active')

@section('menu')
    @include('partials.master.menu.users.dashboard')
@endsection

@section('content')
    <main class="col-md-8 offset-md-2 my-3 p-3">
        <div class="list-group">
            @forelse($health_histories as $health_history)
                <a href="/people/health-history/{{$health_history->id}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div class="media">
                        <img src="{{ asset('img/example-avatar.png') }}" alt="reliqui avatar" class="img-responsive mr-3" width="35" height="35">
                        <p class="media-body mb-0">
                            <strong class="d-block text-gray-dark">{{ $health_history->patient->full_name }}</strong>
                            {{ $health_history->appointment_patient_condition }}
                        </p>
                    </div>

                    <div class="text-secondary">
                        {{ $health_history->created_at->diffForHumans() }}
                    </div>
                </a>
            @empty
                <div class="text-muted text-center mt-2">
                    <strong class="text-muted text-center mt-2">
                        You don't have medical history yet.
                    </strong>
                    <p>when you have, it'll show up here.</p>
                </div>
            @endforelse
        </div>
    </main>
@endsection