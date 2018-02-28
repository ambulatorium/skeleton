@extends('layouts.master')

@section('title', $group->name)
@section('appointments', 'active') 

@section('menu')
    @include('partials.master.menu.groups.appointment')
@endsection

@section('content')
    <main class="col-md-8 offset-md-2 my-3 p-3">    
        @include('partials.groups.appointments.filters')
        @include('partials.groups.appointments.table')
    </main>
@endsection