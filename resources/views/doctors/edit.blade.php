@extends('layouts.master')

@section('title', 'Doctors')
@section('doctors', 'active')

@section('content')
    
    <div class="col-md-4 offset-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-text">Edit Doctor</h4>
            </div>
            <div class="card-body">

                <form method="POST" action="/doctors/{{ $doctor->id }}" class="form-horizontal">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="form-group">
                        <input type="text" class="form-control" name="name"  value="{{ old('name', $doctor->name) }}" autofocus required>
                    </div>
                    <div class="form-group">
                        <select name="gender" id="gender" class="form-control" required>
                            <option value="{{ $doctor->gender }}"> {{ $doctor->gender }}</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="polyclinic_id" id="polyclinic_id" class="form-control" required>
                                <option value="{{ $doctor->polyclinic_id }}"> {{ $doctor->polyclinic->name }}</option>
                            @forelse($polyclinics as $polyclinic)
                                <option value="{{ $polyclinic->id }}">{{ $polyclinic->name }}</option>
                            @empty
                                <option value="">::Polyclinic Empty::</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon">Rp</span>
                        <input type="number" class="form-control" name="price_of_service" value="{{ old('price_of_service', $doctor->price_of_service) }}" required>
                    </div>
                    <div class="form-group">
                        <textarea name="bio" cols="5" rows="3" class="form-control" placeholder="bio">{{ old('bio', $doctor->bio) }}</textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-block btn-danger" type="submit">UPDATE</button>
                        <a href="/doctors/{{ $doctor->id }}" class="btn btn-block btn-secondary">CANCEL</a>
                    </div>
                </form>

            </div>
        </div>

    </div>

@endsection