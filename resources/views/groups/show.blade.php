@extends('layouts.master')

@section('title', $group->health_care_name)
@section('tab-doctors', 'active')

@section('content')

    @include('partials.groups.tab')
    
    <div class="container mt-3">
        <div class="row">

            @forelse($doctors as $doctor)
                <div class="media my-3 p-3 col-md-4">
                    <img src="{{ asset('img/example-avatar.png') }}" alt="avatar" class="img-responsive mr-2" width="50" height="50">                    
                    <p class="media-body pb-3 mb-0 border-bottom">
                        <a href="#" class="d-block"><strong>{{ $doctor->full_name }}</strong></a>
                        {{ $doctor->speciality->name }}
                    </p>
                </div>
            @empty
                <div class="col-md-12 mt-4 text-center">
                    <h5 class="text-muted">
                        <strong class="mb-5">{{ $group->health_care_name }} doesn't have any doctors yet</strong>
                    </h5>
                    <a href="{{ $group->slug }}/settings/invitations" class="btn btn-sm btn-danger">Invite Doctor</a>
                </div>
            @endforelse
            
        </div>
    </div>
@endsection