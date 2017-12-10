<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'health_care_name'      => 'required|min:5',
            'country'               => 'required|min:3',
            'city'                  => 'required|min:3',
            'address'               => 'required|max:60',
            'min_day_appointment'   => 'required',
            'max_day_appointment'   => 'required',
        ];
    }

    public function formGroup()
    {
        return [
            'health_care_name'      => $this->health_care_name,
            'country'               => $this->country,
            'city'                  => $this->city,
            'address'               => $this->address,
            'min_day_appointment'   => $this->min_day_appointment,
            'max_day_appointment'   => $this->max_day_appointment,
        ];
    }
}
