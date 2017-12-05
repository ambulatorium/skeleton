@extends('layouts.master')

@section('title', 'Polyclinics')
@section('polyclinics', 'active')

@section('content')
    <div class="container">
        <div class="row">

            @if($polyclinics->first())
                @include('partials.polyclinic.available')
            @else
                <div class="col-md-4 offset-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h4 class="card-title">Data Polyclinics</h4>
                            <p class="card-text">
                                A polyclinic is a clinic that provides both general and specialist examinations and 
                                treatments to outpatients and is usually independent of a hospital.
                            </p>
                            <p class="card-text">
                                <h6 class="text-muted">
                                    <a href="/polyclinics/create">
                                        Create New Polyclinic
                                    </a>
                                </h6>
                            </p>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection
