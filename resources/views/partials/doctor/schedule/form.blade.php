<form action="/people/schedules" method="POST" class="form-horizontal">
    {{ csrf_field() }}
    <div class="form-row mb-4">
        <div class="form-group col-md-4">
            <label for="day">Day*</label>
            <select name="day" class="form-control" required>
                <option value="Sunday">Sunday</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="start_time">Start Time*</label>
            <input type="time" class="form-control" name="start_time" id="start_time" required>
        </div>
        <div class="form-group col-md-4">
            <label for="end_time">End Time*</label>
            <input type="time" class="form-control" name="end_time" id="end_time" required>
        </div>
        <div class="form-group col-md-4">
            <label for="estimated_service_time">Estimated Service Time*</label>
            <div class="input-group">
                <span class="input-group-addon form-control">In Minutes</span>
                <input type="number" class="form-control" name="estimated_service_time" id="estimated_service_time" required>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="estimated_price_service">Estimated Price Service*</label>
            <input type="number" class="form-control" name="estimated_price_service" id="estimated_price_service" required>
        </div>
        <div class="form-group col-md-4">
            <label for="is_available">Visibility*</label>
            <select name="is_available" class="form-control" required>
                <option value="1">Available</option>
                <option value="0">Unavailbale</option>
            </select>
        </div>
    </div>
    <button class="btn btn-sm btn-danger" type="submit">CREATE</button>
    <a href="/people/schedules" class="btn btn-sm btn-secondary">CANCEL</a>
</form>