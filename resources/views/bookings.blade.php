@extends('layouts.master')

@section('title', 'Make Appointment')
    
@section('content')
<div class="container mb-5">
    <div class="row">

        @if(is_null(Auth::user()->patient->dob))
            <div class="col-md-12 mt-5">
                <div class="alert alert-warning alert-disabled text-center">
                    <h5>Sorry, you do not have permission to schedule an appointment yet. please complete your data as a patient. and make appointment again.</h5>
                    <a href="/people/settings/profile" class="text-center">Complete Profile</a>
                </div>
            </div>
        @else
            @include('partials.bookings.make_appointment')
        @endif

    </div>
</div>
@endsection
