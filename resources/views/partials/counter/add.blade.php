<div class="col-md-3">
    <div class="card bg-light">
        <div class="card-body">
            <p class="text-muted"><strong>Create Counter</strong></p>
            
            <form method="POST" action="/counters" class="form-horizontal">
                {{ csrf_field() }}

                <div class="form-group">
                    <input type="text" class="form-control form-control-sm" name="name" placeholder="counter name" value="{{ old('name') }}" autofocus required>
                </div>
                <div class="form-group">
                    <select name="is_booking" class="form-control form-control-sm" required>
                        <option value="1">Booking</option>
                        <option value="0">Registration</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-sm btn-danger" type="submit">Create</button>
                </div>
            </form>

        </div>
    </div>
</div>