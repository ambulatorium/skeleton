@extends('layouts.master')

@section('title', Auth::user()->name)

@section('content')
    <main class="container my-3 p-3">
        <div class="row">
            
            @include('partials.users.outpatients.form')

            @include('partials.users.outpatients.health_history')

        </div>
    </main>
@endsection