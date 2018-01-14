@extends('layouts.master')

@section('title', Auth::user()->name)
@section('tab-health-history', 'active')

@section('content')

    @include('partials.people.tab')

    <div class="col-md-8 offset-md-2 mt-3">
        <div class="list-group">
            @forelse($health_histories as $health_history)
                <a href="/people/health-history/{{$health_history->id}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div class="text-secondary">
                        <img src="{{ asset('img/example-avatar.png') }}" alt="reliqui avatar" class="img-responsive mr-2" width="28">
                        {{ $health_history->user->name }}
                    </div>

                    <div class="text-secondary">
                        {{ $health_history->created_at->diffForHumans() }}
                    </div>
                </a>
            @empty
                <div class="mt-5">
                    <h5 class="text-muted text-center"><strong>You don't have medical history yet</strong></h5>
                    <h6 class="text-muted text-center">when you have, it'll show up here.</h6>
                </div>
            @endforelse
        </div>
    </div>

@endsection