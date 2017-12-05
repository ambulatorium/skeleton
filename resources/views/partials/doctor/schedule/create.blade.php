<div class="modal fade bd-example-modal-sm" id="createSchedule" tabindex="-1" role="dialog" aria-labelledby="createScheduleLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createScheduleLabel">Create Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="/schedules" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

                    <div class="form-group">
                        <select name="day" class="form-control form-control-sm" required>
                            <option value="Sunday">Sunday</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                        </select>
                    </div>

                    <div class="form-group input-group">
                        <span class="input-group-addon form-control-sm">Start</span>
                        <input type="time" name="from_time" class="form-control form-control-sm" required>

                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon form-control-sm">End</span>
                        <input type="time" name="to_time" class="form-control form-control-sm" required>
                    </div>

                    <button class="btn btn-sm btn-danger" type="sibmit">Create Schedule</button>
                </form>

            </div>
        </div>
    </div>
</div>