<div class="col-md-12 mt-3">
    <div class="list-group">
        <div class="list-group-item">
            <form action="/scheduling/physical-appointment/doctor/{{$doctor->id}}" method="POST">
                {{ csrf_field() }}

                <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                <input type="hidden" name="date" value="{{ request('date') }}">

                <div class="form-group">
                    <h5>Preferred Time</h5>
                    {{--  @further just show available time slot  --}}
                    @for($time=$start_time; $time<=$end_time; $time+=(60*$schedule->estimated_service_time))
                        <label class="btn btn-sm btn-secondary">
                            <input type="radio" name="preferred_time" value="{{ date('g:i:s', $time) }}" autocomplete="off"> 
                                {{ date('g:ia', $time) }}
                        </label>
                    @endfor
                    <hr>
                </div>

                <div class="form-row mt-3">
                    <div class="form-group col-sm-12 col-md-6">
                        <select name="patient_id" class="custom-select form-control" required>
                            <option value="" selected>Choose patient form...</option>
                            @foreach ($patients as $patient)
                                <option value="{{$patient->id}}">{{$patient->form_name}} ({{$patient->full_name}})</option>
                            @endforeach
                        </select>
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
        </div>
    </div>
</div>