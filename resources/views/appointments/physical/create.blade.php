@extends('layouts.master')

@section('title', 'Physical Appointment')

@section('content')
<div class="container">    
    <div class="row">

        @if($patients->count() === 0)
            <div class="col-md-12 mt-5">
                <div class="alert alert-warning text-center">
                    <h5>
                        Sorry, you do not have permission to schedule physical appointment yet. 
                        please create your patient form. and make appointment again.
                    </h5>
                    <a href="/people/settings/patient-form" class="text-center"><strong>AGREE</strong></a>
                </div>
            </div>
        @else
            @include('partials.appointment.physical.profile-doctor')

            @include('partials.appointment.physical.form')
        @endif

    </div>
</div>
@endsection