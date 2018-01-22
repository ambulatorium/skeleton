@extends('layouts.master')

@section('title', Auth::user()->name)
@section('dashboard-schedules', 'active')

@section('menu')
    @include('partials.master.menu.dashboard')
@endsection

@section('content')
    <div class="col-md-8 offset-md-2 mt-3">

        <div class="list-group mt-2">
            @forelse($schedules as $schedule)
                <a href="/people/schedules/{{$schedule->id}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <h5>
                        {{ $schedule->day }}
                        <small>
                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:ia') }} 
                                -
                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:ia') }}
                        </small>
                    </h5>

                    <span class="badge badge-danger">{{ $schedule->appointments_count }} appointment</span>
                </a>
            @empty
                <div class="list-group-item">
                    <h5 class="text-muted text-center"><strong>You don't have any schedule yet</strong></h5>
                    <h6 class="text-muted text-center">when you create schedule, it'll show up here.</h6>
                </div>
            @endforelse
        </div>

        <div class="mt-3 text-center">
            <a href="/people/schedules/create" class="btn btn-outline-secondary btn-sm">CREATE SCHEDULE</a>            
        </div>

    </div>
@endsection