<?php

namespace App\Models\Setting\Speciality;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    protected $table = 'specialities';

    protected $fillable = ['name', 'description'];

    public function doctors()
    {
        return $this->hasMany('App\Models\Doctor\Doctor');
    }
}
