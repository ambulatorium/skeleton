@extends('layouts.master')

@section('title', $group->health_care_name)
@section('tab-doctors', 'active')

@section('content')

    @include('partials.groups.tab')
    
    <div class="container mt-3">
        <div class="row">

            @forelse($doctors as $doctor)
                <div class="col-md-4 mt-4">
                    <h5 class="mb-1">
                        <a href="/{{$group->slug}}/doctor/{{$doctor->name}}">{{ $doctor->name }}</a><p>
                        <small>{{ $doctor->speciality->name }}</small>
                        <hr>
                    </h5>
                </div>
            @empty
                <div class="col-md-12 mt-4">
                    <h5 class="text-muted text-center">
                        <strong>This Health Care Provider doesn't have any doctors yet</strong>
                    </h5>
                </div>
            @endforelse
            
        </div>
    </div>
@endsection