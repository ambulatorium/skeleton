@extends('layouts.master')

@section('title', Auth::user()->name)

@section('content')
    <main class="col-md-8 offset-md-2 my-3 p-3">
        <h4>Create New Schedule</h4>
        <hr>

        @if (Auth::user()->doctor->is_active)
            @include('partials.doctor.schedule.form')
        @else
            <div class="alert alert-warning text-center">
                <h5>
                    Sorry, you do not have permission to create schedule yet.
                    Please complete your profile as a doctor and create schedule again.
                </h5>
                <a href="/people/settings/profile/doctor" class="text-center"><strong>AGREE</strong></a>
            </div>
        @endif
        
    </main>
@endsection