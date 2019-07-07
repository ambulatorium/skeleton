<?php

namespace App\Http\Controllers;

class AmbulatoryController extends Controller
{
    /**
     * Redirect to the Ambulatory path.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return redirect(config('ambulatory.path'));
    }
}
