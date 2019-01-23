<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

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
}
