@extends('layouts.master')

@section('title', 'Profile Doctor')
@section('sidebar_doctor_form', 'active')

@section('content')

    <div class="container mt-5">
        <div class="row">

            @include('partials.people.settings.sidebar')

            <main class="col-sm-8 ml-sm-auto col-md-9 mb-5">
                <div class="card">

                    <div class="card-header">
                        <h5 class="card-text text-capitalize">Profile doctor</h5>
                    </div>

                    <div class="card-body">
                        <form action="/people/settings/profile/doctor/{{$doctorProfile->id}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="speciality_id">Speciality/Polyclinic*</label>
                                    <select name="speciality_id" id="speciality_id" class="form-control" required>
                                        <option value="">Choose one...</option>
                                        @foreach($specialities as $speciality)
                                            <option value="{{ $speciality->id }}" {{ old('speciality_id', $doctorProfile->speciality_id) == $speciality->id  ? 'selected' : '' }}>
                                                {{ $speciality->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="bio">Bio*</label>
                                    <input type="text" class="form-control" id="bio" name="bio" value="{{ old('bio', $doctorProfile->bio) }}" required>
                                </div>
                            </div>
        
                            <button class="btn btn-sm btn-danger" type="submit"><strong>UPDATE</strong></button>
                        </form>
                    </div>

                </div>
            </main>

        </div>
    </div>

@endsection