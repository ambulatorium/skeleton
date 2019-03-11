@extends('layouts.app')

@section('content')
<div class="col-md-8 text-center text-dark mt-5">
    <h1>Ambulatory care platform</h1>
    <p class="lead text-muted">
        Reliqui is designed to meet the needs of outpatient services for health care facilities
    </p>
</div>

<div class="col-md-6 mb-5">
    <form action="{{ route('physical-appointment') }}" method="GET" class="mt-3 shadow rounded">
        <div class="form-group">
            <div class="input-group input-group-lg">
                <select class="custom-select border-0 text-dark" name="location" required>
                    <option selected>Please select location..</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" {{ $location->id == request('location') ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>

                <input type="date"
                    class="form-control border-0"
                    name="date"
                    min="{{ now()->format('Y-m-d') }}"
                    max="{{ now()->addDays(25)->format('Y-m-d') }}"
                    value="{{ request('date') }}"
                    required>

                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">Search</button>
                </div>
            </div>
        </div>
    </form>

    @if (request('location') && request('date'))
        @forelse ($schedules as $schedule)
            <div class="card mt-3 shadow-sm" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{{ $schedule->doctor->user->avatar }}" class="card-img">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body text-dark">
                            <h5 class="card-title">{{ $schedule->doctor->full_name }}</h5>
                            <p class="card-text">
                                {{ $schedule->doctor->bio }} -
                                {{ $schedule->doctor->qualification }} -
                                {{ $schedule->doctor->years_of_experience }} year experienced.
                            </p>
                            <p class="card-text">
                                @foreach ($schedule->doctor->specialties as $speciality)
                                    <span class="badge badge-light">{{ $speciality->name }}</span>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            @if (request('location'))
                <div class="card border-0 shadow-sm p-5 text-center">
                    <h4 class="card-text">data not found</h4>
                </div>
            @endif
        @endforelse
    @endif
</div>
@endsection