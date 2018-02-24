@extends('layouts.master')

@section('title', $doctor->full_name)

@section('content')
    <div class="page-header border-bottom box-shadow-nav pb-1">
        <div class="container">
            @include('partials.doctors.profile')
        </div>
    </div>

    <main class="container">
        <div class="row">
            @include('partials.doctors.schedules')
        </div>
    </main>
@endsection