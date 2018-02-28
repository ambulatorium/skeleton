<form action="/scheduling/physical-appointment/{{$schedule->token}}" method="POST">
    {{ csrf_field() }}

    <input type="hidden" name="date" value="{{ request('date') }}">

    <div class="form-group">
        <p>Choose preferred time for appointment date {{ request('date') }}</p>

        @for($time=$start_time; $time<=$end_time; $time+=(60*$schedule->estimated_service_time))
            <label class="btn btn-sm btn-secondary">
                <input type="radio" name="preferred_time" value="{{ date('H:i:s', $time) }}" autocomplete="off" 
                    @php
                        foreach($appointments as $appointment) {
                            if (date('h:i:s', $time) == $appointment->preferred_time) {
                                echo 'disabled';
                            }
                        }
                    @endphp
                >

                {{ date('g:ia', $time) }}

            </label>
        @endfor
        
        <hr>
    </div>

    <div class="form-row mt-3">
        <div class="form-group col-sm-12 col-md-6">
            @if($patients->count() === 0)
                <div class="alert alert-warning text-center">
                    Patient forms is required for scheduling physical appointment. Your patient forms is empty.
                    <a href="/user/settings/patient-forms/create" class="text-center"><strong>create new</strong></a>
                </div>
            @else
                <select name="patient_id" class="custom-select form-control" required>
                    <option value="" selected>Choose patient form...</option>
                    @foreach ($patients as $patient)
                        <option value="{{$patient->id}}">{{$patient->form_name}} - ({{$patient->full_name}})</option>
                    @endforeach
                </select>
            @endif
        </div>

        <div class="form-group col-12">
            <textarea name="patient_condition" class="form-control" placeholder="current patient condition...." required>
                {{ old('patient_condition') }}
            </textarea>
            <span class="help-block text-muted"><small>*max 160 character</small></span>
        </div>
    </div>

    <button type="submit" class="btn btn-danger float-right">Schedule an appointment</button>
</form>