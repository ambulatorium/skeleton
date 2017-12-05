@extends('layouts.master')

@section('title', 'Polyclinics')
@section('polyclinics', 'active')

@section('content')

    <div class="col-md-4 offset-md-4 mt-1">
        <div class="card">
            <div class="card-header">
                <h4 class="card-text">Edit Polyclinic</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/polyclinics/{{ $polyclinic->id }}" class="form-horizontal">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Polyclinic Name" value="{{ old('name',$polyclinic->name) }}" autofocus required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="location" placeholder="Location: 2nd floor" value="{{ old('location', $polyclinic->location) }}" required>
                    </div>
                    <div class="form-group">
                        <textarea name="service_description" id="service_description" cols="5" rows="5" class="form-control">
                            {{ old('service_description', $polyclinic->service_description) }}
                        </textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-block btn-danger" type="submit">UPDATE</button>
                        <a href="/polyclinics/{{ $polyclinic->id }}" class="btn btn-block btn-secondary">CANCEL</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
