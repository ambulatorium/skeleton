<?php

namespace App\Models\Doctor;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    protected $guarded = [];

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor\Doctor');
    }
}
