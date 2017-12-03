@extends('layouts.master')

@section('title', 'Counters')
@section('counters', 'active')

@section('content')
    <div class="container mt-3">
        <div class="row">

            @forelse($counters as $counter)
                @include('partials.counter.available')
            @empty
                <script>window.location = "/counters/create";</script>
            @endforelse

            @can('add-counters')
                @include('partials.counter.add')
            @endcan

        </div>
    </div>
@endsection
