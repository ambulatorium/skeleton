@extends('layouts.master')

@section('title', 'Create group')

@section('content')
    <main class="col-md-4 offset-md-4 my-3 p-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-text text-capitalize">new healthcare provider</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="/settings/groups" class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name"
                            autofocus required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="country" value="{{ old('country') }}" placeholder="Country" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="city" value="{{ old('city') }}" placeholder="City" required>
                    </div>
                    <div class="form-group">
                        <textarea name="address" cols="5" rows="3" class="form-control" placeholder="Address">{{ old('address') }}</textarea>
                    </div>

                    <hr>
                    <button class="btn btn-sm btn-danger" type="submit">SAVE</button>
                    <a href="/settings/groups" class="btn btn-sm btn-secondary">CANCEL</a>
                </form>
            </div>
        </div>
    </main>
@endsection