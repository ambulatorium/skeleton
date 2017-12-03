@extends('layouts.master')

@section('title', 'Appointment')
@section('appointments', 'active')

@section('content')

<div class="container">
    <div class="row">
    
        <div class="col-12">
            <div class="card tbr-0">
                <div class="card-body">
                
                    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Name</label>
                                <label class="form-control bg-light">{{ $appointment->user->name }}</label> 
                            </div>
                            <div class="form-group col-md-4">
                                <label>E-mail</label>
                                <label class="form-control bg-light">{{ $appointment->user->email }}</label>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Date of birth</label>
                                <label class="form-control bg-light">{{ $appointment->user->patient->dob }}</label>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Gender</label>
                                <label class="form-control bg-light">{{ $appointment->user->patient->gender }}</label>
                            </div>
                            <div class="form-group col-md-4">
                                <label>City</label>
                                <label class="form-control bg-light">{{ $appointment->user->patient->city }}</label>
                            </div>
                            <div class="form-group col-md-4">
                                <label>State</label>
                                <label class="form-control bg-light">{{ $appointment->user->patient->state }}</label>
                            </div>
                            <div class="form-group col-md-8">
                                <label>Address</label>
                                <label class="form-control bg-light">{{ $appointment->user->patient->address }}</label>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Zip Code</label>
                                <label class="form-control bg-light">{{ $appointment->user->patient->zip_code }}</label>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Home Phone</label>
                                <label class="form-control bg-light">{{ $appointment->user->patient->home_phone }}</label>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Cell Phone</label>
                                <label class="form-control bg-light">{{ $appointment->user->patient->cell_phone }}</label>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Marital Status</label>
                                <label class="form-control bg-light">{{ $appointment->user->patient->marital_status }}</label>
                            </div>
                        </div>

                        <div class="alert alert-secondary">
                            <h5>Total Payment: <strong>Rp{{ $appointment->doctor->price_of_service }}</strong></h5>
                        </div>

                        <button class="btn btn-danger" type="submit"><strong>Confirm</strong></button>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection