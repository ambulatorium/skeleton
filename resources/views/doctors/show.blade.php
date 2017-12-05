@extends('layouts.master')

@section('title', 'Doctors')
@section('doctors', 'active')

@section('content')

    <div class="col-md-8 offset-md-2 col-sm-12">

        @include('partials.doctor.manage')

        @include('partials.doctor.profile')

        @can('add-schedules')
            @include('partials.doctor.schedule.create')
        @endcan

        @include('partials.doctor.schedule.show')

    </div>

@endsection