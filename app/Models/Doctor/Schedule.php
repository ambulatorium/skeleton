<?php

namespace App\Models\Doctor;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    protected $fillable = [
        'doctor_id',
        'token',
        'day',
        'start_time',
        'end_time',
        'estimated_service_time',
        'estimated_price_service',
        'is_available',
    ];

    public function getRouteKeyName()
    {
        return 'token';
    }

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor\Doctor');
    }

    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment\Appointment');
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
