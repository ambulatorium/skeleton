<?php

namespace App\Models\Setting\Group;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $fillable = ['health_care_name', 'slug', 'country', 'city', 'address', 'min_day_appointment', 'max_day_appointment'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function doctor()
    {
        return $this->hasMany('App\Models\Doctor\Doctor');
    }

    public function invitation()
    {
        return $this->hasMany('App\Models\Invitation');
    }

    public function staff()
    {
        return $this->hasMany('App\Models\Setting\Staff\Staff');
    }

    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment\Appointment');
    }

    public function path()
    {
        return "/settings/groups/{$this->slug}";
    }

    public function editGroup()
    {
        return "/settings/groups/{$this->slug}/edit";
    }
}
