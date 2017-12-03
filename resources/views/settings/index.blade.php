@extends('layouts.master')

@section('title', 'Settings')
@section('settings', 'active')
@section('sidebar_website', 'active')

@section('content')

    <div class="container">
        <div class="row">

            @include('partials.setting.menu')

            <main class="col-sm-9 ml-sm-auto col-md-10 mt-5 mb-5">
                
                <div class="card">
                    <div class="card-header">
                        {{--  <div class="card-title">  --}}
                        <h4>Website Management <em>(coming soon)</em></h4>
                        {{--  </div>  --}}
                    </div>
                    <div class="card-body">

                        <form action="#" method="#">
                            {{--  {{ csrf_field() }}
                            {{ method_field('PATCH') }}  --}}
                        
                            <div class="form-row mt-5">
                                <div class="form-group col-md-4">
                                    <label for="website_name">Website Name</label>
                                    <input type="text" class="form-control" id="website_name" name="website_name" value="RELIQUI" readonly>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" name="description" value="The Smart Booking System for Outpatient Appointments" readonly>
                                </div>

                                <hr class="col-md-12">
                                <p class="text-mute col-md-12"><strong>Appointment Settings</strong></p>
                                <div class="form-group col-md-4">
                                    <label for="min_make_appointment">Min Make Appointment</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="min_make_appointment" name="min_make_appointment" value="1" readonly>
                                        <span class="input-group-addon" id="basic-addon1">day</span>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="max_make_appointment">Max Make Appointment</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="max_make_appointment" name="max_make_appointment" value="7" readonly>
                                        <span class="input-group-addon" id="basic-addon1">day</span>
                                    </div>
                                </div>

                                <hr class="col-md-12">
                                <p class="text-mute col-md-12"><strong>Google Analytic</strong></p>
                                <div class="form-group col-md-12">
                                    <label for="embed_key">Embed Key</label>
                                    <input type="text" class="form-control" id="embed_key" name="embed_key" value="" readonly>
                                </div>

                            </div>

                            <button class="btn btn-danger" type="submit"><strong>Update</strong></button>
                        </form>

                    </div>
                </div>

            </main>
        </div>
    </div>

@endsection
