<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return arraynumeric
     */
    public function rules()
    {
        return [
            'form_name'       => 'required|string|min:5|max:255',
            'full_name'       => 'required|string|min:2|max:255',
            'dob'             => 'required|date',
            'gender'          => 'required|string|max:7',
            'address'         => 'required|string|max:255',
            'city'            => 'required|string|max:255',
            'state'           => 'required|string|max:255',
            'zip_code'        => 'required|string',
            'home_phone'      => 'nullable|string',
            'cell_phone'      => 'required|string',
            'marital_status'  => 'required|string|max:8',
        ];
    }
}
