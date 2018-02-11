@extends('layouts.auth') 

@section('title', 'Find a doctor')

@section('form')
    <div class="col-md-6 offset-md-3">
        <p class="text-center"><strong>Find a doctor</strong></p>

        <form method="get" action="{{ route('search') }}" class="form-horizontal" accept-charset="UTF-8">
            <div class="form-group">
                <input type="text" class="form-control" name="q" value="{{ request('q') }}" placeholder="type a doctor name" required autofocus>
            </div>
        </form>

        @forelse ($doctors as $doctor)
            <div class="media p-2">
                <img src="{{ asset('img/example-avatar.png') }}" alt="avatar" class="img-responsive mr-3" width="50" height="50">
                <p class="media-body mb-0">
                    <a href="#" class="d-block font-weight-bold text-secondary">
                        {{ $doctor->full_name }}
                    </a>
                    <a href="{{ $doctor->group->slug }}">{{ $doctor->group->name }}.</a>
                    {{ $doctor->group->city }}, {{ $doctor->group->address }}.
                </p>
            </div>
        @empty
            <div class="alert alert-info p-2 text-center">
                No doctors found!
            </div>
        @endforelse

        <div class="mt-5">
            {{ $doctors->links('vendor.pagination.bootstrap-4') }}
        </div>

    </div>
@endsection