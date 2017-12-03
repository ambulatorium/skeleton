<?php

namespace App\Filters;

use App\Models\Doctor\Doctor;

class DoctorFilters extends Filters
{
    protected $filters = ['polyclinic'];

    protected function polyclinic($polyclinic)
    {    
        return $this->builder->whereHas('polyclinic', function ($query) use ($polyclinic) {
            $query->where('name', $polyclinic);
        });
    }
    
}