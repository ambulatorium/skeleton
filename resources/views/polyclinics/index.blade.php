@extends('layouts.master')

@section('title', 'Polyclinics')
@section('polyclinics', 'active')

@section('content')
    <div class="container">
        <div class="row">

            @if($polyclinics->first())
                @include('partials.polyclinic.available')
            @else
                <script>window.location = "/polyclinics/create";</script>
            @endif

        </div>
    </div>

@endsection
