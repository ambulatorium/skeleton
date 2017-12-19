@extends('layouts.master')

@section('title', 'Group Profile')
@section('sidebar_profile', 'active')

@section('content')

    <div class="container mt-3">
        <div class="row">

            @include('partials.groups.settings.menu')

            <main class="col-sm-9 ml-sm-auto col-md-10 mt-5 mb-5">
                
                <div class="card mb-3">

                    <div class="card-header">
                        <h5 class="card-text text-capitalize">Profile</h5>
                    </div>

                    <div class="card-body">
                        <form action="/settings/groups/{{ $group->slug }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="health_care_name">Name</label>
                                    <input type="text" class="form-control" name="health_care_name"  value="{{ old('health_care_name', $group->health_care_name) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" name="country"  value="{{ old('country', $group->country) }}" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" name="address" value="{{ old('address', $group->address) }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" name="city"  value="{{ old('city', $group->city) }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="min_day_appointment">Min day appointment</label>
                                    <input type="number" class="form-control" name="min_day_appointment" value="{{ old('min_day_appointment', $group->min_day_appointment) }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="min_day_appointment">Max day appointment</label>
                                    <input type="number" class="form-control" name="max_day_appointment" value="{{ old('max_day_appointment', $group->max_day_appointment) }}" required>
                                </div>
                            </div>

                            <hr>
                            <button class="btn btn-sm btn-danger" type="submit"><strong>UPDATE</strong></button>
                        </form>
                    </div>

                </div>

            </main>

        </div>
    </div>

@endsection
