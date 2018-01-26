@extends('layouts.master')

@section('title', Auth::user()->name)

@section('content')
    <main class="container my-3 p-3">
        <div class="row">
            <div class="list-group col-md-8">
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>
                        {{ $appointment->user->name }}<small class="mr-5"> account</small>
                        {{ $appointment->patient->full_name }}<small> patient</small>
                    </strong>
                    <span class="badge badge-info">
                        {{ \Carbon\Carbon::parse($appointment->preferred_time)->format('H:ia') }}
                    </span>
                </div>

                <div class="list-group-item">
                    <form action="/people/outpatients/{{$appointment->token}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="patient_condition">Patient condition</label>
                            <div class="alert alert-info bg-light">{{ $appointment->patient_condition }}</div>
                        </div>
                        <div class="form-group">
                            <label for="doctor_diagnosis">Doctor diagnosis</label>
                            <textarea name="doctor_diagnosis" class="form-control" placeholder="Doctor diagnosis..." autofocus required>
                                    {{ old('doctor_diagnosis') }}
                                </textarea>
                            <span class="help-block text-muted"><small>*max 160 character</small></span>
                        </div>
                        <div class="form-group">
                            <label for="doctor_action">Doctor action</label>
                            <textarea name="doctor_action" class="form-control" placeholder="Doctor action..." required>
                                    {{ old('doctor_action') }}
                                </textarea>
                            <span class="help-block text-muted"><small>*max 160 character</small></span>
                        </div>
                        <div class="form-group">
                            <label for="doctor_note">Note</label>
                            <textarea name="doctor_note" class="form-control" placeholder="Doctor note...">
                                    {{ old('doctor_note') }}
                                </textarea>
                            <span class="help-block text-muted"><small>*max 160 character</small></span>
                        </div>
                        <button type="submit" class="btn btn-sm btn-danger">SUBMIT</button>
                        <a href="/people/outpatients" class="btn btn-sm btn-secondary">CANCEL</a>
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <div class="list-group-item">
                    <strong>Health History</strong>
                </div>
                <div id="accordion" role="tablist">
                    <div class="list-group">
                        @forelse ($health_histories as $health_history)
                            <div class="list-group-item">
                                <strong class="mb-0">
                                    <a data-toggle="collapse" href="#{{$health_history->id}}" role="button" aria-expanded="true" aria-controls="{{$health_history->id}}">
                                        #{{ $health_history->created_at->diffForHumans() }}
                                    </a>
                                </strong>
                            </div>
                            <div id="{{$health_history->id}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$health_history->id}}" data-parent="#accordion">
                                <div class="list-group-item bg-light">
                                    <strong>Diagnosis by {{ $health_history->doctor->full_name }}</strong>
                                    {{ $health_history->doctor_diagnosis}}
                                    <hr>
                                    <strong>Action by {{ $health_history->doctor->full_name }}</strong>
                                    <p>
                                    {{ $health_history->doctor_action }}
                                    <hr>
                                    <strong>Note by {{ $health_history->doctor->full_name }}</strong>
                                    <p>
                                    {{ $health_history->doctor_note }}
                                </div>
                            </div>
                        @empty
                            <div class="list-group-item">
                                <strong>EMPTY</strong>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection