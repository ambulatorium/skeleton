<div class="col-md-4 offset-md-4 mt-1">
    <div class="card">
        <div class="card-header">
            <h4 class="card-text">Create Polyclinic</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="/polyclinics" class="form-horizontal">
                {{ csrf_field() }}

                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Polyclinic Name" value="{{ old('name') }}" autofocus required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="location" placeholder="Location: 2nd floor" value="{{ old('location') }}" required>
                </div>
                <div class="form-group">
                    <textarea name="service_description" id="service_description" cols="5" rows="2" class="form-control" placeholder="describe the services provided.">
                        {{ old('service_description') }}
                    </textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-block btn-danger" type="submit">CREATE</button>
                    <a href="/polyclinics" class="btn btn-block btn-secondary">CANCEL</a>
                </div>
            </form>
        </div>
    </div>
</div>