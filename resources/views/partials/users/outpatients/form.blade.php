<div class="list-group col-md-8">
    <div class="list-group-item d-flex justify-content-between align-items-center">
        <strong>
            {{ $appointment->user->name }}<small class="mr-5"> account</small>
            {{ $appointment->patient->full_name }}<small> patient</small>
        </strong>
        <span class="badge badge-info">
            {{ \Carbon\Carbon::parse($appointment->preferred_time)->format('H:ia') }}
        </span>
    </div>

    <div class="list-group-item">
        <form action="/user/outpatients/{{$appointment->token}}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="patient_condition">Patient condition</label>
                <div class="alert alert-info bg-light">{{ $appointment->patient_condition }}</div>
            </div>
            <div class="form-group">
                <label for="doctor_diagnosis">Doctor diagnosis</label>
                <textarea name="doctor_diagnosis" class="form-control" placeholder="..." autofocus required>
                        {{ old('doctor_diagnosis') }}
                    </textarea>
                <span class="help-block text-muted"><small>*max 160 character</small></span>
            </div>
            <div class="form-group">
                <label for="doctor_action">Doctor action</label>
                <textarea name="doctor_action" class="form-control" placeholder="..." required>
                        {{ old('doctor_action') }}
                    </textarea>
                <span class="help-block text-muted"><small>*max 160 character</small></span>
            </div>
            <div class="form-group">
                <label for="doctor_note">Note</label>
                <textarea name="doctor_note" class="form-control" placeholder="...">
                        {{ old('doctor_note') }}
                    </textarea>
                <span class="help-block text-muted"><small>*max 160 character</small></span>
            </div>
            <button type="submit" class="btn btn-sm btn-danger">CHECKOUT</button>
            <a href="/user/outpatients" class="btn btn-sm btn-secondary">CANCEL</a>
        </form>
    </div>
</div>