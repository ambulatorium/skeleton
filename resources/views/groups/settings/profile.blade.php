@extends('layouts.master')

@section('title', 'Group Profile')
@section('group-profile', 'active')

@section('menu')
    @include('partials.master.menu.groups.setting')
@endsection

@section('content')
    <main class="col-md-8 offset-md-2 my-3 p-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-text text-capitalize">setting group profile</h5>
            </div>
            <div class="card-body">
                <form action="{{ $group->appSetting() }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="health_care_name">Name</label>
                            <input type="text" class="form-control" name="name"  value="{{ old('name', $group->name) }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" name="country"  value="{{ old('country', $group->country) }}" required>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" value="{{ old('address', $group->address) }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="city">City</label>
                            <input type="text" class="form-control" name="city"  value="{{ old('city', $group->city) }}" required>
                        </div>
                    </div>

                    <hr>
                    <button class="btn btn-sm btn-danger" type="submit"><strong>UPDATE</strong></button>
                </form>
            </div>
        </div>
    </main>
@endsection
