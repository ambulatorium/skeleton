<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'day'                     => 'required|string|max:10',
            'start_time'              => 'required',
            'end_time'                => 'required',
            'estimated_service_time'  => 'required',
            'estimated_price_service' => 'required',
            'is_available'            => 'required',
        ];
    }

    public function formSchedule()
    {
        return [
            'doctor_id'               => Auth::user()->doctor->id,
            'day'                     => $this->day,
            'start_time'              => $this->start_time,
            'end_time'                => $this->end_time,
            'estimated_service_time'  => $this->estimated_service_time,
            'estimated_price_service' => $this->estimated_price_service,
            'is_available'            => $this->is_available,
        ];
    }
}
