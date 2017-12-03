<div class="float-right">
    <form action="/schedules" method="POST" class="form-inline">
        {{ csrf_field() }}

        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

        <div class="form-group mr-1">
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

        <div class="input-group input-group-sm mr-1">

            <span class="input-group-addon">
                start
            </span>
            <input type="time" name="from_time" class="form-control" required>

            <span class="input-group-addon">
                to
            </span>
            
            <input type="time" name="to_time" class="form-control" required>
            <span class="input-group-addon">
                end
            </span>
        </div>

        <button class="btn btn-sm btn-danger" type="sibmit">Create Schedule</button>
    </form>
</div>