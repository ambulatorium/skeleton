<?php

namespace App\Models\Appointment;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments';

    protected $fillable = [
        'user_id',
        'patient_id',
        'doctor_id',
        'schedule_id',
        'group_id',
        'token',
        'date',
        'preferred_time',
        'patient_condition',
        'status',
    ];

    public function getRouteKeyName()
    {
        return 'token';
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor\Doctor');
    }

    public function schedule()
    {
        return $this->belongsTo('App\Models\Doctor\Schedule');
    }

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient\Patient');
    }

    public function group()
    {
        return $this->belongsTo('App\Models\Setting\Group\Group');
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
