<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $table = 'invitations';

    protected $fillable = ['email', 'role', 'group_id', 'token'];

    public function group()
    {
        return $this->belongsTo('App\Models\Setting\Group\Group');
    }
}
