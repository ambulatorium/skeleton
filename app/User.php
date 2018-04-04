<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
//use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
//use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable //implements HasMedia
{
    //use HasMediaTrait;
    use Notifiable;
    use HasRoles;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function doctor()
    {
        return $this->hasOne('App\Models\Doctor\Doctor');
    }

    public function patientForms()
    {
        return $this->hasMany('App\Models\Patient\Patient');
    }

    public function staff()
    {
        return $this->hasOne('App\Models\Setting\Staff\Staff');
    }

    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment\Appointment');
    }

    public function healthHistory()
    {
        return $this->hasMany('App\Models\Patient\HealthHistory');
    }

    // public function registerMediaConversions(Media $media = null)
    // {
    //     $this->addMediaConversion('thumb')
    //         ->width(50)
    //         ->height(50);
    // }
}
