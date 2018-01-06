@extends('layouts.master')

@section('title', Auth::user()->name)
@section('tab-schedule', 'active')

@section('content')

    @include('partials.people.tab')

    <div class="col-md-8 offset-md-2 mt-3">
        
        @include('partials.people.profile')

        <div class="list-group mt-2">
            @forelse($schedules as $schedule)
                <a href="/people/schedules/{{$schedule->id}}" class="list-group-item list-group-item-action">
                    <h5>
                        {{ $schedule->day }}
                        <small>
                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:ia') }} 
                                -
                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:ia') }}
                        </small>
                    </h5>
                </a>
            @empty
                <div class="list-group-item">
                    <h5 class="text-muted text-center"><strong>You don't have any schedule yet</strong></h5>
                    <h6 class="text-muted text-center">when you create schedule, it'll show up here.</h6>
                </div>
            @endforelse
        </div>

        <div class="mt-3 text-center">
            <a href="/people/schedules/create" class="btn btn-outline-secondary btn-sm">Create schedule</a>            
        </div>

    </div>

@endsection