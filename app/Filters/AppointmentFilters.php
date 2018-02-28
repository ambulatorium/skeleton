<?php

namespace App\Filters;

class AppointmentFilters extends Filters
{
    protected $filters = ['token', 'date'];

    protected function token($token)
    {
        return $this->builder->where('token', 'LIKE', "%$token%");
    }

    protected function date($date)
    {
        return $this->builder->where('date', $date);
    }
}