@extends('layouts.master')

@section('title', $doctor->full_name)

@section('content')
    <div class="page-header border-bottom box-shadow-nav pb-1">
        <div class="container">
            <div class="text-center">
                <img src="{{ asset('img/example-avatar.png') }}" alt="avatar" class="img-responsive mr-2" width="50" height="50">
                <h5 class="pt-2 text-dark">{{$doctor->full_name}}</h5>
            </div>
        </div>
    </div>

    <main class="container">
        <div class="row my-3 p-3">       

        </div>
    </main>
@endsection