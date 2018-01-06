<?php

namespace App\Models\Appointment;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments';

    protected $fillable = [
        'user_id', 'schedule_id', 'appointment_number', 'date',
        'queue_number', 'preferred_time', 'patient_condition', 'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function schedule()
    {
        return $this->belongsTo('App\Models\Doctor\Schedule');
    }

    public function medicalRecord()
    {
        $this->hasMany('App\Models\MedicalRecord\MedicalRecord');
    }
}
