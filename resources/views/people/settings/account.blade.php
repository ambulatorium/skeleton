@extends('layouts.master')

@section('title', 'People - Account Setting')
@section('tab-account', 'active')

@section('content')
<div class="container">
    <div class="row">

        @include('partials.people.tab-settings')

        <div class="list-group col-md-9">

            <div class="list-group-item">
                <strong>Change Password</strong>
            </div>

            <div class="list-group-item">
                <form action="#" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="******" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="******" required>
                        </div>
                    </div>

                    <button class="btn btn-sm btn-danger" type="submit"><strong>Update password</strong></button>
                </form>
            </div>

        </div>

    </div>
</div>

@endsection