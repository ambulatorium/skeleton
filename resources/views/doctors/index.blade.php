@extends('layouts.master')

@section('title', 'All Doctors')

@section('content')
    <div class="container">
        <div class="row">

            @include('partials.doctor.available')

        </div>
    </div>
@endsection