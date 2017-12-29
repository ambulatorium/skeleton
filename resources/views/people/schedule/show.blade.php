@extends('layouts.master')

@section('title', Auth::user()->name)

@section('content')
    <div class="container mb-3">
        <div class="row">

            <div class="col-md-8 mt-5">
                <h4 class="text-muted mb-5">
                    <strong>{{ $schedule->day }}</strong>
                    @if($schedule->is_available)
                        <small class="text-muted">available</small>
                    @else
                        <small class="text-muted">unavailable</small>
                    @endif

                    <div class="dropdown float-right">
                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="manageSchedule" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:ia') }}
                            -
                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:ia') }}
                    </small>
                    <hr>
                </h4>
            </div>

        </div>
    </div>

    <form id="delete-schedule" action="/people/schedules/{{ $schedule->id }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>
@endsection