@extends('layouts.form')

@section('title', 'Patient Registration Form')

@section('form')
<div class="container">
    <main class="my-3 pb-3">
        <h2 class="text-right">Patient Registration Form</h2>
        <p class="mw-60 ml-auto text-right">
            The patient form is an outpatient registration form, 
            you can have more than one form for your family, 
            so please answer thoughtfully and carefully.
        </p>

        @include('partials.master.errors')

        <form action="{{ route('patient-forms.update', $patient_form->id) }}" method="POST">
            {{ method_field('PATCH') }}
            @include('partials.users.patient_form.form', ['buttonText' => 'UPDATE'])
        </form>

    </main>
</div>
@endsection