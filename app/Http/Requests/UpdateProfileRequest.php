<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'dob'            => 'required',
            'gender'         => 'required',
            'city'           => 'required|max:50',
            'state'          => 'required|max:30',
            'address'        => 'required|max:60',
            'zip_code'       => 'required|max:10',
            'home_phone'     => 'required',
            'cell_phone'     => 'required',
            'marital_status' => 'required',
        ];
    }

    public function formProfile()
    {
        return  [
            'dob'            => $this->dob,
            'gender'         => $this->gender,
            'city'           => $this->city,
            'state'          => $this->state,
            'address'        => $this->address,
            'zip_code'       => $this->zip_code,
            'home_phone'     => $this->home_phone,
            'cell_phone'     => $this->cell_phone,
            'marital_status' => $this->marital_status,
        ];
    }
}
