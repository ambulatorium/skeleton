@extends('layouts.master')

@section('title', 'Physical Appointment')

@section('content') 
        
    <div class="col-md-8 offset-md-2 col-sm-12">

        <h4>
            <strong>{{ $doctor->name }},</strong>
            <small class="text-muted"> {{ $doctor->gender }}</small>
        </h4>

        <h6>{{ $doctor->group->health_care_name }}, {{ $doctor->group->city }}  - {{ $doctor->polyclinic->name }} | Rp{{ $doctor->price_of_service }}</h6>

        <ul class="list-group mt-3">
            <li class="list-group-item text-center text-muted">
                @if($doctor->bio)
                    <em>"{{ $doctor->bio }}"</em>"
                @else
                    <em>"No bio yet"</em>
                @endif
            </li>
        </ul>

        <form action="/physical-appointment/scheduling/{{ $doctor->name }}" method="GET" class="form-inline mt-3">
            <input type="hidden" name="date" value="{{ $date }}">
            <div class="input-group">
                
                <select name="preferred_time" class="form-control" required>
                    <option value="">Preferred Time...</option>
                    @for($time=$from_time; $time->diffInSeconds($to_time)>0; $time->addSeconds(900))
                        <option value="{{ $time->toTimeString('G:i') }}">{{ $time->toTimeString('G:i') }}</option>
                    @endfor
                </select>

                <div class="input-group-btn">
                    <button class="btn btn-secondary" type="submit">
                        Scheduling Appointment
                    </button>
                </div>

            </div>
        </form>

    </div>

@endsection