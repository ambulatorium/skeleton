<?php

namespace App\Models\Doctor;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctors';

    protected $fillable = ['polyclinic_id', 'name', 'gender', 'bio', 'price_of_service'];

    public function polyclinic()
    {
        return $this->belongsTo('App\Models\Polyclinic\Polyclinic');
    }

    public function schedule()
    {
        return $this->hasMany('App\Models\Doctor\Schedule');
    }

    public function appointment()
    {
        return $this->hasMany('App\Models\Appointment\Appointment');
    }

    // public function scopeFilter($query, $filters)
    // {
    //     return $filters->apply($query);
    // }
}
