@csrf
<div class="form-group">
    <input type="text" class="form-control" name="name" value="{{ old('name', $speciality->name) }}" placeholder="Name" autofocus required>
</div>

<div class="form-group">
    <input type="text" class="form-control" name="description" value="{{ old('description', $speciality->description) }}" placeholder="Description" required>
</div>
    
<hr>
<button class="btn btn-sm btn-danger" type="submit">{{ $buttonText ?? 'SAVE' }}</button>
<a href="{{ route('specialities.index') }}" class="btn btn-sm btn-secondary">CANCEL</a>