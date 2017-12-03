@extends('layouts.master')

@section('title', 'Doctors')
@section('doctors', 'active')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-12">
                @can('edit-doctors')
                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                        <a href="/doctors/{{ $doctor->id }}/edit" class="btn btn-outline-danger btn-sm">Edit Doctor</a>
                        <a href="/doctors/appointments/{{ $doctor->id }}" class="btn btn-outline-danger btn-sm">Appointments</a>
                    </div>
                @endcan

                @include('partials.doctor.profile')
            </div>

            <div class="col-12 mt-5">
                @can('add-schedules')
                    @include('partials.doctor.schedule.create')
                @endcan

                @include('partials.doctor.schedule.show')
            </div>

        </div>
    </div>

@endsection