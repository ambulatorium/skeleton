@extends('layouts.master')

@section('title', 'Edit Speciality')

@section('content')
    <main class="col-md-4 offset-md-4 my-3 p-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-text text-capitalize">Edit Speciality</h5>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('specialities.update', ['speciality' => $speciality->slug]) }}" class="form-horizontal">
                    @method('patch')
                    @include('partials.settings.speciality.form', ['buttonText' => 'UPDATE'])
                </form>
            </div>
        </div>
    </main>
@endsection