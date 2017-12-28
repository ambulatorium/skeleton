<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'speciality_id'    => 'required',
            'bio'              => 'required|string|max:160',
            // @todo add all information about doctor
        ];
    }

    public function formDoctor()
    {
        return [
            'speciality_id'    => $this->speciality_id,
            'bio'              => $this->bio,
            'status'           => true,
            // @todo add all information about doctor
        ];
    }
}
