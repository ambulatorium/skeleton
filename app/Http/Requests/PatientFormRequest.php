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
     * @return array
     */
    public function rules()
    {
        return [
            'form_name'       => 'required|string|min:5|max:255',
            'full_name'       => 'required|string|max:255',
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

    public function patientRegistrationForm()
    {
        return [
            'user_id'        => auth()->id(),
            'form_name'      => $this->form_name,
            'full_name'      => $this->full_name,
            'dob'            => $this->dob,
            'gender'         => $this->gender,
            'address'        => $this->address,
            'city'           => $this->city,
            'state'          => $this->state,
            'zip_code'       => $this->zip_code,
            'home_phone'     => $this->home_phone,
            'cell_phone'     => $this->cell_phone,
            'marital_status' => $this->marital_status,
        ];
    }
}
