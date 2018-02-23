<?php

namespace App\Filters;

class DoctorFilters extends Filters
{
    protected $filters = ['name'];

    protected function name($full_name)
    {
        return $this->builder->where('full_name', 'LIKE', "%$full_name%");
    }
}
