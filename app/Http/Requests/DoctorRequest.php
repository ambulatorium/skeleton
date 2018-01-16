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
            'speciality_id'       => 'required',
            'full_name'           => 'required|string|max:255',
            'years_of_experience' => 'required|numeric',
            'qualification'       => 'required|string|max:25',
            'bio'                 => 'required|string|max:160',
        ];
    }

    public function formDoctor()
    {
        return [
            'speciality_id'       => $this->speciality_id,
            'full_name'           => $this->full_name,
            'years_of_experience' => $this->years_of_experience,
            'qualification'       => $this->qualification,
            'bio'                 => $this->bio,
            'is_active'           => true,
        ];
    }
}
