@extends('layouts.master')

@section('title', 'Physical Appointment')

@section('content')
<div class="container">    
    <div class="row">
        @includeWhen(!$appointment->patient->is_verified, 'partials.groups.appointments.patient', ['patient_form' => $appointment->patient])
        @includeWhen($appointment->patient->is_verified, 'partials.groups.appointments.checkin', ['appointment' => $appointment])
    </div>
</div>
@endsection