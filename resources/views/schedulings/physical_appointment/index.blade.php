@extends('layouts.master')

@section('title', 'Physical Appointment')

@section('content')
<div class="container">
    <div class="row">
    
        <div class="col-md-12">
            <div class="list-group">
                <div class="list-group-item">
                    <a class="float-right btn btn-sm btn-outline-danger" data-toggle="collapse" href="#change-search" aria-expanded="false" aria-controls="change-search">Change Search</a>
                    {{ request('location') }} - {{ request('speciality') }} - {{ \Carbon\Carbon::parse( request('date') )->format('l, d F Y') }}

                    <div class="collapse mt-3" id="change-search">
                        <form action="/scheduling/physical-appointment" method="GET" class="form-inline">
                            <div class="form-group mr-1">
                                <select name="location" class="form-control form-control-sm" required>
                                    <option value="">Choose location...</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->name }}" {{ request('location') == $location->name ? 'selected' : '' }}>
                                            {{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mr-1">
                                <select name="speciality" class="form-control form-control-sm" required>
                                    <option value="">Choose specialities...</option>
                                    @foreach($specialities as $speciality)
                                        <option value="{{ $speciality->name }}" {{ request('speciality') == $speciality->name ? 'selected' : '' }}>
                                            {{ $speciality->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group mr-1">
                                <input type="date" class="form-control form-control-sm" name="date" value="{{ request('date') }}" min="{{ Carbon\Carbon::tomorrow()->format('Y-m-d') }}" max="{{ Carbon\Carbon::tomorrow()->addDays(7)->format('Y-m-d') }}" required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-sm btn-danger" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
        </div>
        
        @include('partials.schedulings.physical_appointment.doctors_schedule')

    </div>
</div>
@endsection