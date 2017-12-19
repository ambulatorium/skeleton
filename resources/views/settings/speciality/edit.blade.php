@extends('layouts.master')

@section('title', 'Settings - Speciality - Edit')

@section('content')
    <div class="col-md-4 offset-md-4">

        <div class="card">
            <div class="card-header">
                <h4 class="card-text text-center">Edit Speciality</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/settings/specialities/{{ $speciality->id }}" class="form-horizontal">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="form-group">
                        <input type="text" class="form-control" name="name"  value="{{ old('name', $speciality->name) }}" autofocus required>
                    </div>
                    <div class="form-group">
                        <textarea name="description" cols="5" rows="3" class="form-control">
                            {{ old('description', $speciality->description) }}
                        </textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-block btn-danger" type="submit">UPDATE</button>
                        <a href="/settings/specialities" class="btn btn-block btn-secondary">CANCEL</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection