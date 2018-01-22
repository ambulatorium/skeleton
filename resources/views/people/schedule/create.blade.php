@extends('layouts.master')

@section('title', Auth::user()->name)

@section('content')
    <div class="container mb-3">
        <div class="row">

            <div class="col-md-8 offset-md-2 mt-5">
                <h4 class="text-muted mb-5"><strong>Create New Schedule</strong></h4>

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
                
            </div>

        </div>
    </div>
@endsection