@extends('layouts.master')

@section('title', 'All Appointments')

@section('content')
    <div class="container">
        <div class="row">

            @include('partials.appointment.all')

        </div>
    </div>
@endsection