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
            'polyclinic_id'    => 'required',
            'group_id'         => 'required',
            'name'             => 'required|min:5',
            'gender'           => 'required',
            'bio'              => 'nullable|max:160',
            'price_of_service' => 'required',
        ];
    }

    public function formDoctor()
    {
        return [
            'polyclinic_id'    => $this->polyclinic_id,
            'group_id'         => $this->group_id,
            'name'             => $this->name,
            'gender'           => $this->gender,
            'bio'              => $this->bio,
            'price_of_service' => $this->price_of_service,
        ];
    }
}
