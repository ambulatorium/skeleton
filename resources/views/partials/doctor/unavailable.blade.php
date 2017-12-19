<div class="col-md-4 offset-md-4">

    <div class="card tbr-0">
        <div class="card-header">
            <h4 class="card-text text-center">Add Doctor</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="/doctors" class="form-horizontal">
                {{ csrf_field() }}

                <div class="form-group">
                    <select name="group_id" id="group_id" class="form-control" required>   
                        <option value="">Health Care Provider...</option>
                        @forelse($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->health_care_name }} - {{ $group->city }}</option>
                        @empty
                            <option value="">::Empty::</option>
                        @endforelse
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="name"  value="{{ old('name') }}" placeholder="Doctor's Name" required>
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
                        <option value="">Select Speciality...</option>
                        @forelse($specialities as $speciality)
                            <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                        @empty
                            <option value="">::speciality Empty::</option>
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
                    <a href="/doctors" class="btn btn-block btn-secondary">CANCEL</a>
                </div>
            </form>
        </div>
    </div>

</div>