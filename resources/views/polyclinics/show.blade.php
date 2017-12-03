@extends('layouts.master')

@section('title', 'Polyclinic')
@section('polyclinics', 'active')

@section('content')

    <div class="col-md-8 offset-md-2 mt-4">

        @can('edit-polyclinics')
            <a href="#" class="btn btn-outline-danger btn-sm float-right">Edit Polyclinic <em>(soon)</em></a>
        @endcan

        <h4><strong>{{ $polyclinic->name }}, </strong>
            <small>-</small>
        </h4>
        <h6 class="text-muted">{{ $polyclinic->location }}</h6>
        <h6 class="text-muted">Date added {{ $polyclinic->created_at->format('j F, Y g:ia') }}</h6>

        <div class="card mt-4">
            <div class="card-body bg-light">
                <p class="card-text text-center">
                    {{ $polyclinic->service_description }}
                </p>
            </div>
        </div>
    </div>

@endsection