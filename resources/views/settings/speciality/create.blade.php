@extends('layouts.master')

@section('title', 'Settings - Specialities - Create')

@section('content')
    <div class="col-md-4 offset-md-4">

        <div class="card">
            <div class="card-header">
                <h4 class="card-text">New Specialities</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/settings/specialities" class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="text" class="form-control" name="name"  value="{{ old('name') }}" placeholder="Name" autofocus required>
                    </div>
                    <div class="form-group">
                        <textarea name="description" cols="5" rows="3" class="form-control" placeholder="Description">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-block btn-danger" type="submit">ADD</button>
                        <a href="/settings/specialities" class="btn btn-block btn-secondary">CANCEL</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection