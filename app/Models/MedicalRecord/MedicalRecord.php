<?php

namespace App\Models\MedicalRecord;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $table = 'medical_records';

    protected $fillable = [
        'user_id', 'patient_id', 'appointment_id', 'doctor_diagnosis', 'doctor_actions'
    ];

    public function appointment()
    {
        return $this->belongsTo('App\Models\Appointment\Appointment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient\Patient');
    }
}
