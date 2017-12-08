@extends('layouts.master')

@section('title', 'Physician')

@section('content')
<div class="container">    
    <div class="row">
    
        <div class="col-md-12">
            <div class="list-group">
                <div class="list-group-item">
                    <a class="float-right btn btn-sm btn-outline-danger" data-toggle="collapse" href="#change-search" aria-expanded="false" aria-controls="change-search">Change Search</a>
                    <strong>{{ $polyclinic }} - {{ \Carbon\Carbon::parse($date)->format('l, d F Y') }}</strong>

                    <div class="collapse mt-3" id="change-search">
                        <form action="/physician" method="GET" class="form-inline">
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
        
        @forelse($schedules as $schedule)
            <div class="col-md-6 mt-4">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">
                                {{ $schedule->doctor->name }} -
                                <small class="text-muted">{{ $schedule->doctor->gender }}</small>
                            </h5>
                            <p class="text-muted">
                                <strong>
                                    Rp{{ $schedule->doctor->price_of_service }}
                                </strong>
                            </p>
                        </div>
                        <div class="d-flex w-100 justify-content-between">
                            <p class="mb-1">
                                Working Hours
                                {{ \Carbon\Carbon::parse($schedule->from_time)->format('h:ia') }} 
                                        -
                                {{ \Carbon\Carbon::parse($schedule->to_time)->format('h:ia') }}
                            </p>
                        </div>
                        <small>You can pay the service charge at the counter.</small>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-md-12 mt-4">
                <ul class="list-group">
                    <li class="list-group-item text-center">
                        <strong class="text-muted">Sorry, Doctor's schedule is not yet available.</strong>
                    </li>
                </ul>
            </div>
        @endforelse

    </div>
</div>
@endsection