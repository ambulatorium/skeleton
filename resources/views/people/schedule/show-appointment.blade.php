@extends('layouts.master')

@section('title', Auth::user()->name)

@section('content')

    <div class="container mt-3">
        <div class="row">

            <div class="list-group col-md-8">
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>{{ $appointment->user->name }}</strong>
                       
                    <span class="badge badge-info">
                        {{ \Carbon\Carbon::parse($appointment->preferred_time)->format('H:ia') }}
                    </span>
                </div>

                <div class="list-group-item">
                    <form action="/people/doctor/appointments/{{$appointment->token}}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="patient_condition">Patient condition</label>
                            <div class="alert alert-info bg-light">{{ $appointment->patient_condition }}</div>
                        </div>

                        <div class="form-group">
                            <label for="doctor_diagnosis">Doctor diagnosis</label>
                            <textarea name="doctor_diagnosis" class="form-control" placeholder="Doctor diagnosis..." autofocus required>
                                {{ old('doctor_diagnosis') }}
                            </textarea>
                            <span class="help-block text-muted"><small>*max 160 character</small></span>
                        </div>
                        <div class="form-group">
                            <label for="doctor_action">Doctor action</label>
                            <textarea name="doctor_action" class="form-control" placeholder="Doctor action..." required>
                                {{ old('doctor_action') }}
                            </textarea>
                            <span class="help-block text-muted"><small>*max 160 character</small></span>
                        </div>
                        <div class="form-group">
                            <label for="doctor_note">Note</label>
                            <textarea name="doctor_note" class="form-control" placeholder="Doctor note...">
                                {{ old('doctor_note') }}
                            </textarea>
                            <span class="help-block text-muted"><small>*max 160 character</small></span>
                        </div>

                        <button type="submit" class="btn btn-danger">SAVE</button>
                        <a href="/people/doctor/appointments" class="btn btn-secondary">CANCEL</a>
                    </form>
                </div>
            </div>
                

            <div class="col-md-4">
                <div class="list-group-item">
                    <strong>Health History</strong>
                </div>

                <div id="accordion" role="tablist">
                    <div class="list-group">
                        <div class="list-group-item">
                            <strong class="mb-0">
                                <a data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="true" aria-controls="collapseOne">
                                    #28 Agustus 2018
                                </a>
                            </strong>
                        </div>
                        <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="list-group-item bg-light">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>

                        <div class="list-group-item">
                            <strong class="mb-0">
                                <a data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="true" aria-controls="collapseTwo">
                                    #13 September 2018
                                </a>
                            </strong>
                        </div>
                        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="list-group-item bg-light">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection