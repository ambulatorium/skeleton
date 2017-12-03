@extends('layouts.master')

@section('title', 'People - Medical Record')
@section('tab-medical-record', 'active')

@section('content')
<div class="container">
    <div class="row">

        @include('partials.people.tab')

        <div class="list-group col-md-8">

            <div class="list-group-item">
                <strong>Your Medical Record</strong>
            </div>

            {{--  <div class="list-group-item">  --}}
                @forelse($medicalRecords as $medicalRecord)
                    <div href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ \Carbon\Carbon::parse($medicalRecord->created_at)->format('l, d F Y') }}</h5>
                            <p class="text-muted"><strong>{{ $medicalRecord->appointment->doctor->name }} - {{ $medicalRecord->user->name }}</strong></p>
                        </div>
                        <div class="d-flex w-100 justify-content-between">
                            <p class="mb-1 text-muted">
                                <strong>
                                    {{ $medicalRecord->doctor_diagnosis }}
                                </strong>
                            </p>
                            <hr>
                        </div>
                        <small>{{ $medicalRecord->doctor_actions }}</small>
                    </div>
                @empty
                    <div href="#" class="list-group-item">
                        <h5 class="text-muted text-center mt-3"><strong>You don’t have any medical record yet</strong></h5>
                        <h6 class="text-muted text-center">when you receiving medical attention, it'll show up here.</h6>
                    </div>
                @endforelse
            {{--  </div>  --}}

        </div>

    </div>
</div>

@endsection