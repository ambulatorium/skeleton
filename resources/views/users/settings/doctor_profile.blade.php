@extends('layouts.master')

@section('title', 'Profile Doctor')
@section('setting-doctor-form', 'active')

@section('menu')
    @include('partials.master.menu.users.setting')
@endsection

@section('content')
    <main class="col-md-8 offset-md-2 my-3 p-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-text text-capitalize">Profile doctor</h5>
            </div>
            <div class="card-body">

                <form action="{{ route('profileDoctor.update', $doctorProfile->slug) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="full_name">Full Name*</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name', $doctorProfile->full_name) }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="years_of_experience">Years of experience*</label>
                            <input type="number" max="80" class="form-control" id="years_of_experience" name="years_of_experience" value="{{ old('years_of_experience', $doctorProfile->years_of_experience) }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="qualification">Qualification*</label>
                            <input type="text" class="form-control" id="qualification" name="qualification" value="{{ old('qualification', $doctorProfile->qualification) }}" placeholder="example MBBS, MS, etc" required>
                        </div>
                        <div class="form-group col-md-8">
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

                    <hr>
                    <button class="btn btn-sm btn-danger" type="submit"><strong>UPDATE</strong></button>
                </form>

            </div>
        </div>
    </main>
@endsection