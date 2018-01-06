<?php

namespace App\Models\Setting\Speciality;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    protected $table = 'specialities';

    protected $fillable = ['name', 'description'];

    public function doctor()
    {
        return $this->hasOne('App\Models\Doctor\Doctor');
    }
}
