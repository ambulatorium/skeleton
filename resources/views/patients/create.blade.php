@extends('layouts.master')

@section('title', 'New Patient')
@section('patients', 'active')

@section('content')
    
    <div class="col-md-8 offset-md-2">
        
        <div class="card">
            <div class="card-header">
                <h4 class="card-text text-center"><strong>Patient's Form</strong></h4>
            </div>
            <div class="card-body">
                <form action="#" method="#">
                    {{ csrf_field() }}
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" autofocus required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="dob">Date of birth</label>
                            <input type="date" class="form-control" name="dob" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="">Select Gender...</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="city">City</label>
                            <input type="text" class="form-control" name="city" value="{{ old('city') }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="state">State</label>
                            <input type="text" class="form-control" name="state" value="{{ old('state') }}" required>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" value="{{ old('address') }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="zip_code">Zip Code</label>
                            <input type="text" class="form-control" name="zip_code" value="{{ old('zip_code') }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="home_phone">Home Phone</label>
                            <input type="number" class="form-control" name="home_phone" value="{{ old('home_phone') }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="cell_phone">Cell Phone</label>
                            <input type="number" class="form-control" name="cell_phone" value="{{ old('cell_phone') }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="marital_status">Marital Status</label>
                            <select name="marital_status" id="marital_status" class="form-control" required>
                                <option value="Married">Married</option>
                                <option value="Single">Single</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-danger" type="submit"><strong>SAVE</strong></button>
                </form>
            </div>
        </div>

    </div>

@endsection
