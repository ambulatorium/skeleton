@extends('layouts.master')

@section('title', 'Group Staffs')
@section('sidebar_staffs', 'active')

@section('content')

    <div class="container mt-3">
        <div class="row">

            @include('partials.groups.settings.menu')

            <main class="col-sm-9 ml-sm-auto col-md-10 mt-5 mb-5">
                
                <div class="card mb-3">

                    <div class="card-header">
                        <h5 class="card-text text-capitalize">Add staffs</h5>
                    </div>

                </div>

                <div class="card mb-3">

                    <div class="card-header">
                        <h5 class="card-text text-capitalize">3 staffs</h5>
                    </div>

                </div>

            </main>

        </div>
    </div>

@endsection
