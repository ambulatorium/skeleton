@extends('layouts.master')

@section('title', 'Appointment')
@section('appointments', 'active')

@section('content')

<div class="container">
    <div class="row">
    
        <div class="col-12">
            <div class="card tbr-0">
                <div class="card-body">
                
                    <form action="/medical-record" method="POST">
                        {{ csrf_field() }}

                        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                        <input type="hidden" name="doctor_id" value="{{ $appointment->doctor->id }}">
                        <input type="hidden" name="patient_id" value="{{ $appointment->user->patient->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                        <div class="alert alert-secondary">
                            <h5>Patient Name: <strong>{{ $appointment->user->name }}</strong></h5>
                        </div>

                        <div class="form-group">
                            <label for="doctor_diagnosis"></label>
                            <textarea class="form-control" name="doctor_diagnosis" id="doctor_diagnosis" cols="10" rows="5" placeholder="Doctor Diagnosis..." required>
                                {{ old('doctor_diagnosis') }}
                            </textarea>
                            <span class="text-block text-muted"><small>*Max 160 character</small></span>
                        </div>

                        <div class="form-group">
                            <label for="doctor_actions"></label>
                            <textarea class="form-control" name="doctor_actions" id="doctor_actions" cols="10" rows="5" placeholder="Doctor's Actions..." required>
                                {{ old('doctor_actions') }}
                            </textarea>
                            <span class="text-block text-muted"><small>*Max 160 character</small></span>
                        </div>

                        <button class="btn btn-danger" type="submit"><strong>Save to medical record</strong></button>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection