@extends('layouts.master')

@section('title', $group->health_care_name)
@section('tab-appointments', 'active')

@section('content')

    @include('partials.groups.tab')
    
    <div class="container mt-3">
        <div class="row">

            @forelse($appointments as $appointment)
                <div class="col-md-4 mt-4">
                    <h5 class="mb-1">
                        <a href="#">{{ $appointment->user->name }}</a><p>
                        <small>
                            {{ \Carbon\Carbon::parse($appointment->date)->format('l') }},
                            {{ \Carbon\Carbon::parse($appointment->date)->format('d F Y') }},
                            {{ \Carbon\Carbon::parse($appointment->preferred_time)->format('H:ia') }}
                        </small>
                        <hr>
                    </h5>
                </div>
            @empty
                <div class="col-md-12 mt-4 text-center">
                    <h5 class="text-muted">
                        <strong class="mb-5">This Healthcare Provider doesn't have any appointment yet</strong>
                    </h5>
                </div>
            @endforelse
            
        </div>
    </div>
@endsection