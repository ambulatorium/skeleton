<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkRelationships($model, $relationships)
    {
        $counts = array();
        
        foreach ($relationships as $relationship) {
            if ($y = $model->$relationship()->count()) {
                $counts[] = $y;
            }
        }

        return $counts;
    }

}