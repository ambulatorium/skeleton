<?php

namespace App\Http\Requests;

use App\Models\Appointment\Appointment;
use Illuminate\Foundation\Http\FormRequest;

class PhysicalAppointmentRequest extends FormRequest
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
            'patient_id'        => 'required|exists:patients,id',
            'date'              => 'required|date',
            'preferred_time'    => 'required',
            'patient_condition' => 'required|max:160',
        ];
    }

    public function formPhysicalAppointment()
    {
        return [
            'user_id'            => auth()->id(),
            'patient_id'         => $this->patient_id,
            'doctor_id'          => $this->schedule->doctor->id,
            'schedule_id'        => $this->schedule->id,
            'group_id'           => $this->schedule->doctor->group->id,
            'token'              => $this->generateToken(),
            'date'               => $this->date,
            'preferred_time'     => $this->preferred_time,
            'patient_condition'  => $this->patient_condition,
            'status'             => 'scheduled',
        ];
    }

    protected function generateToken()
    {
        $token = str_random(6);

        if (Appointment::where('token', $token)->first()) {
            $this->generateToken();
        }

        return $token;
    }
}
