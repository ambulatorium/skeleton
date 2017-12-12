@extends('layouts.master')

@section('title', 'The Smart Booking System for Outpatient Appointments')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center"><strong>Search Doctor Schedule</strong></h5>
                        <p class="card-subtitle text-center">
                            Choose polyclinic and date for your appointment
                        </p>
                    </div>
                    <div class="card-body">
                        <form action="/physical-appointment" method="get" class="form-horizontal">

                            <div class="form-group">
                                <select name="location" class="form-control" required>
                                    <option value="">Select location...</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->health_care_name }}"> {{ $location->health_care_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="polyclinic" class="form-control" required>
                                    <option value="">Select Polyclinic...</option>
                                    @foreach($polyclinics as $polyclinic)
                                        <option value="{{ $polyclinic->name }}"> {{ $polyclinic->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="date" name="date" class="form-control" min="{{ Carbon\Carbon::tomorrow()->format('Y-m-d') }}" max="{{ Carbon\Carbon::tomorrow()->addDays(7)->format('Y-m-d') }}" required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger btn-block" type="submit">SEARCH</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8 d-none d-md-block mt-3">
                <h2 class="text-center text-muted mb-3"><strong>The Smart Booking System for Outpatient Appointments</strong></h2>
                <p class="text-center text-muted"><strong>
                    In Reliqui the outpatient applicant can choose the schedule anytime they want and the specialist they need as long as the doctor’s schedule available, 
                    the outpatient applicant could ease the experience of making Doctor’s appointment online, 
                    it could save the time of the outpatient applicant so when they come to the healthcare service provider they just going straight to specialist without filling any patient’s data form.
                    </strong>
                </p>
            </div>
            
            
        </div>

    </div>

@endsection