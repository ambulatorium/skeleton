<?php

namespace App\Models\Setting\Speciality;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    protected $table = 'specialities';

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function getRouteKeyName()
    {
    	return 'slug';
    }

    public function doctors()
    {
        return $this->hasMany('App\Models\Doctor\Doctor');
    }
    
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = str_slug($name);
    }
}
