@extends('layouts.master')

@section('title', 'Profiles')
@section('tab-profile', 'active')

@section('content')
<div class="container">
    <div class="row">

        @include('partials.people.tab-settings')

        <div class="list-group col-md-9">

            <div class="list-group-item">
                <strong>Your Profile</strong>
            </div>

            <div class="list-group-item">
                <form action="/people/settings/profile/{{ Auth::user()->id }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" readonly required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="dob">Date of birth</label>
                            <input type="date" class="form-control" name="dob" value="{{ Auth::user()->patient->dob }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control" required>
                                @if(Auth::user()->patient->gender)
                                    <option value="{{ Auth::user()->patient->gender }}">{{ Auth::user()->patient->gender }}</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                @else
                                    <option value="">Select Gender...</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="city">City</label>
                            <input type="text" class="form-control" name="city" value="{{ old('city', Auth::user()->patient->city) }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="state">State</label>
                            <input type="text" class="form-control" name="state" value="{{ old('city', Auth::user()->patient->state) }}" required>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" value="{{ old('city', Auth::user()->patient->address) }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="zip_code">Zip Code</label>
                            <input type="text" class="form-control" name="zip_code" value="{{ old('city', Auth::user()->patient->zip_code )}}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="home_phone">Home Phone</label>
                            <input type="number" class="form-control" name="home_phone" value="{{ old('city', Auth::user()->patient->home_phone) }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="cell_phone">Cell Phone</label>
                            <input type="number" class="form-control" name="cell_phone" value="{{ old('city', Auth::user()->patient->cell_phone) }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="marital_status">Marital Status</label>
                            <select name="marital_status" id="marital_status" class="form-control" required>
                                @if(Auth::user()->patient->marital_status)
                                    <option value="{{ Auth::user()->patient->marital_status }}">{{ Auth::user()->patient->marital_status }}</option>
                                    <option value="Married">Married</option>
                                    <option value="Single">Single</option>
                                    <option value="Divorced">Divorced</option>
                                @else
                                    <option value="">Select Marital Status...</option>
                                    <option value="Married">Married</option>
                                    <option value="Single">Single</option>
                                    <option value="Divorced">Divorced</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-sm btn-danger" type="submit"><strong>Update</strong></button>
                </form>
            </div>

        </div>

    </div>
</div>

@endsection