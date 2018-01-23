@extends('layouts.master')

@section('title', 'Edit Speciality')

@section('content')
    <main class="col-md-4 offset-md-4 mt-4 mb-3">
        <h4 class="text-center">Edit Speciality</h4>
        <hr>
        
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
    </main>
@endsection