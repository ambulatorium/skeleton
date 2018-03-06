<div class="col-md-12">
    <div class="list-group">
        <div class="list-group-item">
            <div class="alert alert-info text-center bg-white text-dark">
                <strong class="text-uppercase">
                    please verify outpatients data
                </strong>
            </div>

            <form action="/{{$group->slug}}/appointments/{{$appointment->token}}/{{$patient_form->id}}" method="POST">
                @method('patch')
                @include('partials.users.patient_form.form', [
                    'buttonText' => 'VERIFY',
                    'buttonLink' => '/'.$group->slug.'/appointments',
                    'textInfo'   => 'when you have verified outpatient, you will be directed to checkin page.'
                ])
            </form>
        </div>  
    </div>
</div>