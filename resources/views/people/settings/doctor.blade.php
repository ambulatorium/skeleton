@extends('layouts.master')

@section('title', 'Profile Doctor')
@section('tab-doctor', 'active')

@section('content')
<div class="container">
    <div class="row">

        @include('partials.people.tab-settings')

        <div class="list-group col-md-9">

            <div class="list-group-item">
                <strong>Doctor Information</strong>
            </div>

            <div class="list-group-item">
                <form action="/people/settings/profile/doctor/{{$doctorProfile->id}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    
                    {{--  <input type="hidden" name="status" value="1">  --}}
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="speciality_id">Speciality/Polyclinic</label>
                            <select name="speciality_id" id="speciality_id" class="form-control" required>
                                @if(!$doctorProfile->speciality_id)
                                    <option value="">Select Speciality...</option>
                                    @foreach($specialities as $speciality)
                                        <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                                    @endforeach
                                @else
                                    <option value="{{ $doctorProfile->speciality_id }}">{{ $doctorProfile->speciality->name }}</option>
                                    @foreach($specialities as $speciality)
                                        <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="bio">Bio</label>
                            <textarea name="bio" id="bio" cols="5" rows="5" class="form-control">
                                {{ old('bio', $doctorProfile->bio) }}
                            </textarea>
                        </div>
                    </div>

                    <button class="btn btn-sm btn-danger" type="submit"><strong>UPDATE</strong></button>
                </form>
            </div>

        </div>

    </div>
</div>

@endsection