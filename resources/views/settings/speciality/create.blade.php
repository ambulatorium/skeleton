@extends('layouts.master')

@section('title', 'Create Speciality')

@section('content')
    <main class="col-md-4 offset-md-4 my-3 p-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-text text-capitalize">new Specialities</h5>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('specialities.store') }}" class="form-horizontal">
                    @include('partials.settings.speciality.form')
                </form>
            </div>
        </div>
    </main>
@endsection