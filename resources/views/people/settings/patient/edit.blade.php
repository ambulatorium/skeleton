@extends('layouts.master')

@section('title', 'Patient Registration Form')

@section('content')

    <div class="container">
        <div class="row">

            <main class="col-md-10 offset-md-1 mb-3 mt-3">
                <div class="card">

                    <div class="card-header">
                        <h5 class="card-text text-capitalize">Edit Patient Form</h5>
                    </div>

                    <div class="card-body">
                        <form action="/people/settings/patient-form/{{$patient->id}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="form_name">Form Name</label>
                                    <input type="string" class="form-control" name="form_name" value="{{ old('form_name', $patient->form_name) }}" placeholder="example, my-form or my-grandpa" required>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="full_name">Patient Full Name</label>
                                    <input type="string" class="form-control" name="full_name" value="{{ old('full_name', $patient->full_name) }}" placeholder="The patient's full name." required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="dob">Date of birth</label>
                                    <input type="date" class="form-control" name="dob" value="{{ old('dob', $patient->dob) }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="gender">Gender</label>
                                    <select name="gender" id="gender" class="form-control" required>
                                        <option value="{{$patient->gender}}">{{$patient->gender}}</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" name="city" value="{{ old('city', $patient->city) }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" name="state" value="{{ old('state', $patient->state) }}" required>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" name="address" value="{{ old('address', $patient->address) }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="zip_code">Zip Code</label>
                                    <input type="text" class="form-control" name="zip_code" value="{{ old('zip_code', $patient->zip_code)}}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="home_phone">Home Phone</label>
                                    <input type="number" class="form-control" name="home_phone" value="{{ old('home_phone', $patient->home_phone) }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="cell_phone">Cell Phone</label>
                                    <input type="number" class="form-control" name="cell_phone" value="{{ old('cell_phone', $patient->cell_phone) }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="marital_status">Marital Status</label>
                                    <select name="marital_status" id="marital_status" class="form-control" required>
                                        <option value="{{$patient->marital_status}}">{{$patient->marital_status}}</option>
                                        <option value="Married">Married</option>
                                        <option value="Single">Single</option>
                                        <option value="Divorced">Divorced</option>
                                    </select>
                                </div>
                            </div>

                            <hr>
                            <button class="btn btn-danger" type="submit">Update</button>
                            <a href="/people/settings/patient-form" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>

                </div>
            </main>

        </div>
    </div>

@endsection