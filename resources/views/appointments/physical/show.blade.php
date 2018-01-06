@extends('layouts.master')

@section('title', 'Physical Appointment')

@section('content')
<div class="container">    
    <div class="row">
    
        @include('partials.appointment.physical.profile-doctor')

        @include('partials.appointment.physical.schedule-doctor')

    </div>
</div>
@endsection