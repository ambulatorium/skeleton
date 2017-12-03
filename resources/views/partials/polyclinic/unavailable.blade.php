<div class="col-md-4 offset-md-4 mt-5">
    <div class="card text-center">
        <div class="card-body">
            <h4 class="card-title">Data Polyclinics</h4>
            <p class="card-text">
                A polyclinic is a clinic that provides both general and specialist examinations and treatments to outpatients and is usually independent of a hospital.
            </p>
            <p class="card-text">
                <h6 class="text-muted">
                    <a href="#pClinic" data-toggle="collapse" aria-expanded="false" aria-controls="pClinic">
                        Create New Polyclinic
                    </a>
                
                </h6>
            </p>
        </div>
    </div>
</div>
<div class="collapse col-md-4 offset-md-4 mt-1" id="pClinic">
    <div class="card bg-light">
        <div class="card-body">
            <form method="POST" action="/polyclinics" class="form-horizontal">
                {{ csrf_field() }}

                <div class="form-group">
                    <input type="text" class="form-control form-control-sm" name="name" placeholder="Polyclinic Name" value="{{ old('name') }}" autofocus required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-sm" name="location" placeholder="Location: 3nd floor" value="{{ old('location') }}" required>
                </div>
                <div class="form-group">
                    <textarea name="service_description" id="service_description" cols="5" rows="2" class="form-control" placeholder="describe the services provided.">
                        {{ old('service_description') }}
                    </textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-sm btn-block btn-danger" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>