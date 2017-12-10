@extends('layouts.master')

@section('title', 'Settings - Health Care Provider - Edit')
@section('settings', 'active')

@section('content')
    <div class="col-md-4 offset-md-4">

        <div class="card">
            <div class="card-header">
                <h4 class="card-text">Edit Health Care</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/settings/groups/{{ $group->id }}" class="form-horizontal">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="form-group">
                        <input type="text" class="form-control" name="health_care_name"  value="{{ old('health_care_name', $group->health_care_name) }}" autofocus required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="country"  value="{{ old('country', $group->country) }}" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="city"  value="{{ old('city', $group->city) }}" required>
                    </div>
                    <div class="form-group">
                        <textarea name="address" cols="5" rows="3" class="form-control" placeholder="Address">
                            {{ old('address', $group->address) }}
                        </textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="number" class="form-control" name="min_day_appointment" value="{{ old('min_day_appointment', $group->min_day_appointment) }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="number" class="form-control" name="max_day_appointment" value="{{ old('max_day_appointment', $group->max_day_appointment) }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-block btn-danger" type="submit">UPDATE</button>
                        <a href="/settings/groups" class="btn btn-block btn-secondary">CANCEL</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection