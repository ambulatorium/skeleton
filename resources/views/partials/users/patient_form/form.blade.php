{{ csrf_field() }}

<div class="row form-section">
    <div class="col-sm-4">
        <h4>Title Patient Form</h4>
        <small class="form-text text-muted">
            For future scheduling appointments.
        </small>
    </div>
    <div class="col-sm-8">
        <div class="row">
            <div class="col-sm-6">
                <input type="text" class="form-control" name="form_name" value="{{ old('form_name', $patient_form->form_name ?? '') }}" placeholder="Form name: e.g. my-grandpa" required>
            </div>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="full_name" value="{{ old('full_name', $patient_form->full_name ?? '') }}" placeholder="Patient's full name." required>                                
            </div>
        </div>
    </div>
</div>

<div class="row form-section">
    <div class="col-sm-4">
        <h4>Patient Details</h4>
        <small class="form-text text-muted">
            All fields other than home phone ones are required.
        </small>
    </div>
    <div class="col-sm-8">
        <div class="row">
            <div class="col-sm-6">
                <input type="date" class="form-control" name="dob" value="{{ old('dob', $patient_form->dob  ?? '') }}" required>
                <small class="form-text text-muted">date of birth</small>
            </div>
            <div class="col-sm-6">
                <select name="gender" id="gender" class="form-control" required>
                    <option value="Male" {{ old('gender', $patient_form->gender  ?? '') == 'Male'  ? 'selected' : '' }}>
                        Male
                    </option>
                    <option value="Female" {{ old('gender', $patient_form->gender  ?? '') == 'Female'  ? 'selected' : '' }}>
                        Female
                    </option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <input type="text" class="form-control" name="city" value="{{ old('city', $patient_form->city  ?? '') }}" placeholder="city" required>
            </div>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="state" value="{{ old('state', $patient_form->state  ?? '') }}" placeholder="state" required>           
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <input type="text" class="form-control" name="address" value="{{ old('address', $patient_form->address  ?? '') }}" placeholder="address" required>         
            </div>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="zip_code" value="{{ old('zip_code', $patient_form->zip_code  ?? '')}}" placeholder="zip code" required>                     
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <input type="number" class="form-control" name="home_phone" value="{{ old('home_phone', $patient_form->home_phone  ?? '') }}" placeholder="home phone">
            </div>
            <div class="col-sm-6">
                <input type="number" class="form-control" name="cell_phone" value="{{ old('cell_phone', $patient_form->cell_phone  ?? '') }}" placeholder="cell phone" required>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <select name="marital_status" id="marital_status" class="form-control" required>
                    <option value="Married" {{ old('marital_status', $patient_form->marital_status  ?? '') == 'Married'  ? 'selected' : '' }}>
                        Married
                    </option>
                    <option value="Single" {{ old('marital_status', $patient_form->marital_status  ?? '') == 'Single'  ? 'selected' : '' }}>
                        Single
                    </option>
                    <option value="Divorced" {{ old('marital_status', $patient_form->marital_status ?? '') == 'Divorced'  ? 'selected' : '' }}>
                        Divorced
                    </option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row form-section">
    <div class="col-sm-4">
        <h4>What's Next?</h4>
    </div>
    <div class="col-sm-8">
        <p>
            Once you have a patient form, you can select the patient's form when making an appointment.
        </p>

        <button type="submit" class="btn btn-info mt-4">{{ $buttonText ?? 'SUBMIT' }}</button>
        <a href="{{ route('patient-forms.index') }}" class="btn btn-secondary mt-4">CANCEL</a>                    
    </div>
</div>