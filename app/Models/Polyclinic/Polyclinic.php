<?php

namespace App\Models\Polyclinic;

use Illuminate\Database\Eloquent\Model;

class Polyclinic extends Model
{
    protected $table = 'polyclinics';

    protected $fillable = ['name', 'location', 'service_description'];

    public function doctor()
    {
        return $this->hasOne('App\Models\Doctor\Doctor');
    }
}
