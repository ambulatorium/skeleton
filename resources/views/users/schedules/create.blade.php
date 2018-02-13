@extends('layouts.master')

@section('title', Auth::user()->name)

@section('content')
    <main class="col-md-8 offset-md-2 my-3 p-3">
        <h4>Create New Schedule</h4>
        <hr>

        @include('partials.users.schedules.form')
        
    </main>
@endsection