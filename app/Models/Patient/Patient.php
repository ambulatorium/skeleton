<?php

namespace App\Models\Patient;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Patient extends Model
{
    use HasRoles;
    
    protected $table = 'patients';

    protected $fillable = [
        'user_id', 'dob', 'gender', 'address', 'city', 'state', 'zip_code', 'home_phone', 'cell_phone', 'marital_status', 'register_from'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function medicalRecord()
    {
        $this->hasMany('App\Models\MedicalRecord\MedicalRecord');
    }

}
