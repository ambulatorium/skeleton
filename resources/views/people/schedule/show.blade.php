@extends('layouts.master')

@section('title', Auth::user()->name)
@section('dashboard-schedules', 'active')

@section('menu')
    @include('partials.master.menu.users.dashboard')
@endsection

@section('content')
    <main class="col-md-8 offset-md-2 my-3 p-3">
        <h4 class="text-secondary">
            <strong>{{ $schedule->day }}</strong>
            @if($schedule->is_available)
                <small class="text-muted">available</small>
            @else
                <small class="text-muted">unavailable</small>
            @endif

            <div class="dropdown float-right">
                <button class="btn btn-sm btn-outline-danger dropdown-toggle" type="button" id="manageSchedule" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Manage
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="manageSchedule">
                    <a href="/people/schedules/{{$schedule->id}}/edit" class="dropdown-item">Edit</a>
                
                    <a href="/people/schedules/{{ $schedule->id }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('delete-schedule').submit();">
                        Delete
                    </a>
                </div>
            </div>

            <small>
                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('g:ia') }}
                    -
                    {{ \Carbon\Carbon::parse($schedule->end_time)->format('g:ia') }}
            </small>
        </h4>

        <div class="list-group mt-5">
            @forelse($appointments as $appointment)
                <div class="list-group-item">
                    <h5>
                        {{ \Carbon\Carbon::parse($appointment->date)->format('d F Y') }}
                        preferred time {{ \Carbon\Carbon::parse($appointment->preferred_time)->format('H:ia') }}
                        with {{ $appointment->patient->full_name }}
                    </h5>
                </div>
            @empty
                <h5 class="text-muted text-center"><strong>This schedule don't have any appointment yet</strong></h5>
            @endforelse
        </div>

    </main>

    <form id="delete-schedule" action="/people/schedules/{{ $schedule->id }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>
@endsection