<?php

namespace App\Models\Setting\Group;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $fillable = [
        'name',
        'slug',
        'country',
        'city',
        'address',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function doctors()
    {
        return $this->hasMany('App\Models\Doctor\Doctor');
    }

    public function invitations()
    {
        return $this->hasMany('App\Models\Invitation');
    }

    public function staffs()
    {
        return $this->hasMany('App\Models\Setting\Staff\Staff');
    }

    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment\Appointment');
    }

    public function healthHistory()
    {
        return $this->hasMany('App\Models\Patient\HealthHistory');
    }

    public function appSetting()
    {
        return "/settings/groups/{$this->slug}";
    }
}
