@extends('layouts.master')

@section('title', 'The Smart Booking System for Outpatient Appointments')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-4 col-sm-12">
                <div class="card tbr-0">
                    <div class="card-header">
                        <h5 class="card-title text-center"><strong>Search Doctor Schedule</strong></h5>
                        <p class="card-subtitle text-center">
                            Choose polyclinic and date for your appointment
                        </p>
                    </div>
                    <div class="card-body">
                        <form action="/scheduling/physical-appointment" method="get" class="form-horizontal">

                            <div class="form-group">
                                <select name="location" class="form-control" required>
                                    <option value="">Select location...</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->health_care_name }}"> {{ $location->health_care_name }} - {{ $location->city }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="speciality" class="form-control" required>
                                    <option value="">Select Speciality...</option>
                                    @foreach($specialities as $speciality)
                                        <option value="{{ $speciality->name }}"> {{ $speciality->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="date" name="date" class="form-control" min="{{ Carbon\Carbon::tomorrow()->format('Y-m-d') }}" max="{{ Carbon\Carbon::tomorrow()->addDays(7)->format('Y-m-d') }}" required>
                            </div>

                            <button class="btn btn-secondary btn-block" type="submit">SEARCH</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8 d-none d-md-block mt-5">
                <h2 class="text-muted mb-3 ml-2"><strong>The Smart Scheduling System for Outpatient Appointments</strong></h2>
                <p class="text-muted ml-2"><strong>
                    In Reliqui the outpatient applicant can choose the schedule anytime they want and the specialist they need as long as the doctor’s schedule available, 
                    the outpatient applicant could ease the experience of making Doctor’s appointment online, 
                    it could save the time of the outpatient applicant so when they come to the healthcare service provider they just going straight to specialist without filling any patient’s data form.
                    </strong>
                </p>
            </div>
            
        </div>
    </div>

@endsection