@extends('layouts.master')

@section('title', 'Create Speciality')

@section('content')
    <main class="col-md-4 offset-md-4 mt-4 mb-3">
        <h4 class="text-center">New Specialities</h4>
        <hr>

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

    </main>
@endsection