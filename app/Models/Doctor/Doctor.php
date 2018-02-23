<?php

namespace App\Models\Doctor;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctors';

    protected $fillable = [
        'user_id',
        'group_id',
        'speciality_id',
        'full_name',
        'slug',
        'years_of_experience',
        'qualification',
        'bio',
        'is_active',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function appointment()
    {
        return $this->hasMany('App\Models\Appointment\Appointment');
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

    public function healthHistory()
    {
        return $this->hasMany('App\Models\Patient\HealthHistory');
    }

    public function setSlugAttribute($value)
    {
        if (static::whereSlug($slug = str_slug($value))->exists()) {
            $slug = "{$slug}-{$this->id}";
        }

        $this->attributes['slug'] = $slug;
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
