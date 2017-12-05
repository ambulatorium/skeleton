@extends('layouts.master')

@section('title', 'Polyclinic')
@section('polyclinics', 'active')

@section('content')

    <div class="col-md-8 offset-md-2 col-sm-12">

        @include('partials.polyclinic.manage')

        <h4><strong>{{ $polyclinic->name }}</strong></h4>
        <h6>{{ $polyclinic->location }}</h6>
        <h6>Date added {{ $polyclinic->created_at->format('j F, Y g:ia') }}</h6>

        <div class="mt-4">
            <div>
                <div class="list-group-item">
                    <p class="text-center">
                        {{ $polyclinic->service_description }}
                    </p>
                </div>
            </div>
        </div>

    </div>

@endsection