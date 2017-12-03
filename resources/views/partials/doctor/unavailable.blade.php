<div class="col-md-4 offset-md-4">

    <div class="card">
        <div class="card-header">
            <h4 class="card-text">Add Doctor</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="/doctors" class="form-horizontal">
                {{ csrf_field() }}

                <div class="form-group">
                    <input type="text" class="form-control" name="name"  value="{{ old('name') }}" placeholder="Doctor's Name" autofocus required>
                </div>
                <div class="form-group">
                    <select name="gender" id="gender" class="form-control" required>
                        <option value="">Select Gender...</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="form-group">
                    <select name="polyclinic_id" id="polyclinic_id" class="form-control" required>
                            <option value="">Select Polyclinic...</option>
                        @forelse($polyclinics as $polyclinic)
                            <option value="{{ $polyclinic->id }}">{{ $polyclinic->name }}</option>
                        @empty
                            <option value="">::Polyclinic Empty::</option>
                        @endforelse
                    </select>
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="number" class="form-control" name="price_of_service" value="{{ old('price_of_service') }}" placeholder="Price of Service" required>
                </div>
                <div class="form-group">
                    <textarea name="bio" cols="5" rows="3" class="form-control" placeholder="bio">{{ old('bio') }}</textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-block btn-danger" type="submit">ADD</button>
                </div>
            </form>
        </div>
    </div>

</div>