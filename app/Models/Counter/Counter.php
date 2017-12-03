<?php

namespace App\Models\Counter;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $table = 'counters';

    protected $fillable = ['name', 'is_booking', 'is_active'];
}
