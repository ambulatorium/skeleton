<?php

namespace App\Models\Setting\Group;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $fillable = ['health_care_name', 'country', 'city', 'address', 'min_day_appointment', 'max_day_appointment'];

    public function doctor()
    {
        return $this->hasMany('App\Models\Doctor\Doctor');
    }
}
