<div class="col-md-4 offset-md-4 mt-5">
    <div class="card text-center">
        <div class="card-body">
            <h4 class="card-title">Data Counters</h4>
            <p class="card-text">
                Counters adalah tempat penerimaan pasien rawat jalan,
                anda harus membuat loket baru agar tersedia bagi antrian pasien.
            </p>
            <p class="card-text">
                <h6 class="text-muted">
                    <a href="#cCounter" data-toggle="collapse" aria-expanded="false" aria-controls="cCounter">
                        Create New Counter
                    </a>
                </h6>
            </p>
        </div>
    </div>
</div>
<div class="collapse col-md-4 offset-md-4 mt-1" id="cCounter">
    <div class="card bg-light">
        <div class="card-body">
            <form method="POST" action="/counters" class="form-horizontal">
                {{ csrf_field() }}

                <div class="form-group">
                    <input type="text" class="form-control form-control-sm" name="name" placeholder="counter name" value="{{ old('name') }}" autofocus required>
                    <span class="text-muted help-block"><small>This counter will be active by default</small></span>
                </div>
                <div class="form-group">
                    <select name="is_booking" class="form-control form-control-sm" required>
                        <option value="1">Booking</option>
                        <option value="0">Registration</option>
                    </select>
                    <span class="help-block"><small>*counter category</small></span>
                </div>

                <div class="form-group">
                    <button class="btn btn-sm btn-block btn-danger" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>