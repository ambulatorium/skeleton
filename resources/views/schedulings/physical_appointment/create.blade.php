@extends('layouts.master')

@section('title', 'Physical Appointment')

@section('content')
<div class="container">    
    <div class="row">

        @include('partials.schedulings.physical_appointment.profile_doctor')

        <div class="col-md-12 mt-3">
            <div class="list-group">
                <div class="list-group-item">
                    @include('partials.schedulings.physical_appointment.form')
                </div>
            </div>
        </div>

    </div>
</div>
@endsection