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
            'health_care_name'      => 'required|min:5|unique:groups',
            'country'               => 'required|min:3',
            'city'                  => 'required|min:3',
            'address'               => 'required|max:60',
        ];
    }

    public function formGroup()
    {
        return [
            'health_care_name'      => $this->health_care_name,
            'slug'                  => str_slug($this->health_care_name, '-'),
            'country'               => $this->country,
            'city'                  => $this->city,
            'address'               => $this->address,
        ];
    }
}
