@extends('layouts.master')

@section('title', 'Your Profile')
@section('setting-patients', 'active')

@section('menu')
    @include('partials.master.menu.users.settings')
@endsection

@section('content')
    <main class="col-md-8 offset-md-2 my-3 p-3">

        <div class="table-responsive">
            <table class="table table-hover table-rq box-shadow-table">
                <thead class="thead-rq">
                    <tr>
                        <th>Form Name</th>
                        <th>Patient Name</th>
                        <th>Gender</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patients as $patient)
                        <tr>
                            <td>{{ $patient->form_name }}</td>
                            <td>{{ $patient->full_name }}</td>
                            <td>{{ $patient->gender }}</td>                                        
                            <td>
                                <form action="{{ route('patient-form.destroy', $patient->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <a href="{{ route('patient-form.edit', $patient->id) }}" class="btn btn-secondary btn-sm">edit</a>
                                    <button class="btn btn-danger btn-sm" type="submit">delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td>You don't have any patient form</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <a href="{{ route('patient-form.create') }}" class="btn btn-sm btn-light float-right active">Add New</a>
    
    </main>
@endsection