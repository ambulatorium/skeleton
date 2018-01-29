@extends('layouts.master')

@section('title', 'Explore')
@section('explore', 'active')

@section('content')
    <div class="page-header border-bottom box-shadow-nav">
        <div class="container text-secondary">
            @foreach ($specialities as $speciality)
                <a href="#" class="badge badge-info">{{ $speciality->name }}</a>
            @endforeach
        </div>
    </div>
    <main class="container my-3 p-3">
        <div class="row">
            <div class="col-md-8">
                <h4 class="text-dark font-weight-bold">
                    Healthcare Provider
                </h4><br>
                
                @forelse ($groups as $group)
                    <a href="/{{$group->slug}}">
                        <h4 class="font-weight-bold">
                            {{ $group->health_care_name }}
                        </h4>
                    </a>
                    <p>{{ $group->address }}, {{ $group->city }}.</p>
                    <hr>
                @empty
                    <h4>Empty healthcare provider</h4>
                @endforelse
            </div>

            <div class="col-md-4">
                <h4 class="text-dark font-weight-bold">
                    Doctors
                </h4><br>

                @forelse ($doctors as $doctor)
                    <div class="media">
                        <img src="{{ asset('img/example-avatar.png') }}" alt="avatar" class="img-responsive mr-2" width="50" height="50">
                        <p class="media-body pb-3 mb-0">
                            <a href="#" class="d-block font-weight-bold">
                                {{ $doctor->full_name }}
                            </a> 
                            {{ $doctor->speciality->name }}
                        </p>
                    </div>
                @empty
                    <h4>Doctors empty</h4>
                @endforelse
            </div>
        </div>
    </main>
@endsection