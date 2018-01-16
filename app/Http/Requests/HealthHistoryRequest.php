<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HealthHistoryRequest extends FormRequest
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
            'doctor_diagnosis' => 'required|string|max:160',
            'doctor_action'    => 'required|string|max:160',
            'doctor_note'      => 'nullable|string|max:160',
        ];
    }

    public function formHealthHistory()
    {
        return [
            'user_id'                          => $this->appointment->user_id,
            'patient_id'                       => $this->appointment->patient_id,
            'doctor_id'                        => $this->appointment->doctor_id,
            'group_id'                         => $this->appointment->group_id,
            'appointment_date'                 => $this->appointment->date,
            'appointment_time'                 => $this->appointment->preferred_time,
            'appointment_patient_condition'    => $this->appointment->patient_condition,
            'schedule_start_time'              => $this->appointment->schedule->start_time,
            'schedule_end_time'                => $this->appointment->schedule->end_time,
            'schedule_estimated_service_time'  => $this->appointment->schedule->estimated_service_time,
            'schedule_estimated_price_service' => $this->appointment->schedule->estimated_price_service,
            'doctor_diagnosis'                 => $this->doctor_diagnosis,
            'doctor_action'                    => $this->doctor_action,
            'doctor_note'                      => $this->doctor_note,
        ];
    }
}
