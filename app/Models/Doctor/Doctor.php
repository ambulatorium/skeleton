<?php

namespace App\Models\Doctor;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctors';

    protected $fillable = ['user_id', 'group_id', 'speciality_id', 'gender', 'bio'];

    // public function getRouteKeyName()
    // {
    //   return 'name';   
    // }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function group()
    {
        return $this->belongsTo('App\Models\Setting\Group\Group');
    }

    public function speciality()
    {
        return $this->belongsTo('App\Models\Setting\Speciality\Speciality');
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
