@extends('layouts.master')

@section('title', 'Doctors')
@section('doctors', 'active')

@section('content')
    <div class="container">
        <div class="row">
            @if($doctors->first())
                @include('partials.doctor.available')
            @else
                <script>window.location = "/doctors/create";</script>
            @endif
        </div>
    </div>
@endsection
