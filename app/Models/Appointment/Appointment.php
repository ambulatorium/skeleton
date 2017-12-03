<?php

namespace App\Models\Appointment;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments';
    
    protected $fillable = [
        'user_id', 'doctor_id', 'appointment_number', 'date_of_visit', 
        'queue_number', 'patient_condition', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor\Doctor');
    }

    public function medicalRecord()
    {
        $this->hasMany('App\Models\MedicalRecord\MedicalRecord');
    }
}
