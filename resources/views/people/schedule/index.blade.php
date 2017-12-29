@extends('layouts.master')

@section('title', Auth::user()->name)
@section('tab-schedule', 'active')

@section('content')

    @include('partials.people.tab')

    <div class="container">
        <div class="row">

            @forelse($schedules as $schedule)
                <div class="col-md-4 mt-5">
                    <div class="list-group text-center">
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="text-muted">
                                <h1>{{ $schedule->day }}</h1>
                            </div>
                            <small class="mb-1">
                                Working Hours
                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:ia') }} 
                                        -
                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:ia') }}
                            </small>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-md-12 mt-5 text-center">
                    <h5 class="text-muted"><strong>You don't have any schedule yet</strong></h5>
                    <h6 class="text-muted">when you make an schedule, it'll show up here.</h6>
                    <a href="/people/schedules/create" class="btn btn-danger btn-sm mt-3">Create schedule</a>
                </div>
            @endforelse

        </div>
    </div>
@endsection