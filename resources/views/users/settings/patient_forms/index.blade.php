@extends('layouts.master')

@section('title', 'Patient forms')
@section('setting-patient-forms', 'active')

@section('menu')
    @include('partials.master.menu.users.setting')
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
                                <form action="{{ route('patient-forms.destroy', $patient->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <a href="{{ route('patient-forms.edit', $patient->id) }}" class="btn btn-secondary btn-sm">edit</a>
                                    <button class="btn btn-danger btn-sm" type="submit">delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        <a href="{{ route('patient-forms.create') }}" class="btn btn-sm btn-light float-right active">Add New</a>
    
    </main>
@endsection