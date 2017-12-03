@extends('layouts.master')

@section('title', 'Doctors')

@section('content')
<div class="container">    
    <div class="row">
    
        <div class="col-12">
            <div class="list-group">
                <div class="list-group-item">
                    <a class="float-right btn btn-sm btn-outline-danger" data-toggle="collapse" href="#change-search" aria-expanded="false" aria-controls="change-search">Change Search</a>
                    <strong>{{ $polyclinic }} - {{ \Carbon\Carbon::parse($date)->format('l, d F Y') }}</strong>

                    <div class="collapse mt-3" id="change-search">
                        <form action="/doctors/search" method="GET" class="form-inline">
                            <div class="form-group mr-1">
                                <select name="polyclinic" class="form-control form-control-sm" required>
                                    <option value="{{ $polyclinic }}">{{ $polyclinic }}</option>
                                    
                                    @foreach($polyclinics as $polyclinic)
                                        <option value="{{ $polyclinic->name }}">{{ $polyclinic->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group mr-1">
                                <input type="date" class="form-control form-control-sm" name="date" value="{{ $date }}" min="{{ Carbon\Carbon::tomorrow()->format('Y-m-d') }}" max="{{ Carbon\Carbon::tomorrow()->addDays(7)->format('Y-m-d') }}" required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-sm btn-danger" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
        </div>
        
        <div class="col-md-8 mt-4">
            <ul class="list-group">
                @forelse($schedules as $schedule)
                    <li class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">
                                {{ $schedule->doctor->name }} -
                                <small class="text-muted">{{ $schedule->doctor->gender }}</small>
                            </h5>
                            <p class="text-muted">
                                <strong>
                                    {{ \Carbon\Carbon::parse($schedule->from_time)->format('h:ia') }} 
                                        -
                                    {{ \Carbon\Carbon::parse($schedule->to_time)->format('h:ia') }}
                                </strong>
                            </p>
                        </div>
                        {{--  right now just support Rupiah currencies, (manual)  --}}
                        <div class="d-flex w-100 justify-content-between">
                            <p class="mb-1 text-muted">
                                <strong>
                                    Service Charge Rp{{ $schedule->doctor->price_of_service }}
                                </strong>
                            </p>
                            <form action="/bookings" method="GET">
                                {{ csrf_field() }}

                                <input type="hidden" name="doctor_id" value="{{ $schedule->doctor->id }}">
                                <input type="hidden" name="date_of_visit" value="{{ $date }}">
                                <button class="btn btn-danger btn-sm" type="submit">Choose</button>
                            </form>
                        </div>
                        <small>You can pay the service charge at the counter.</small>
                    </li>
                @empty
                    <li class="list-group-item text-center">
                        <strong class="text-muted">Sorry, Doctor's schedule is not yet available.</strong>
                    </li>
                @endforelse
            </ul>
        </div>

    </div>
</div>
@endsection
