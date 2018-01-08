<?php

namespace App\Http\Requests;

use App\Models\Appointment\Appointment;
use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'schedule_id'       => 'required|exists:schedules,id',
            'date'              => 'required|date',
            'preferred_time'    => 'required',
            'patient_condition' => 'required|max:160',
        ];
    }

    public function formAppointment()
    {
        return [
            'user_id'            => $this->user_id,
            'schedule_id'        => $this->schedule_id,
            'group_id'           => $this->doctor->group->id,
            'appointment_number' => $this->generateAppointmentNumber(),
            'date'               => $this->date,
            'preferred_time'     => $this->preferred_time,
            'patient_condition'  => $this->patient_condition,
            'status'             => 'scheduled',
        ];
    }

    protected function generateAppointmentNumber()
    {
        $appointment_number = str_random(6);

        if (Appointment::where('appointment_number', $appointment_number)->first()) {
            $this->generateAppointmentNumber();
        }

        return $appointment_number;
    }
}
