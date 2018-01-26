@extends('layouts.master')

@section('title', 'Edit Speciality')

@section('content')
    <main class="col-md-4 offset-md-4 my-3 p-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-text text-capitalize">edit speciality</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="/settings/specialities/{{ $speciality->id }}" class="form-horizontal">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="form-group">
                        <input type="text" class="form-control" name="name" value="{{ old('name', $speciality->name) }}" autofocus required>
                    </div>
                    <div class="form-group">
                        <textarea name="description" cols="5" rows="3" class="form-control">
                            {{ old('description', $speciality->description) }}
                        </textarea>
                    </div>

                    <hr>
                    <button class="btn btn-sm btn-danger" type="submit">UPDATE</button>
                    <a href="/settings/specialities" class="btn btn-sm btn-secondary">CANCEL</a>
                </form>
            </div>
        </div>
    </main>
@endsection