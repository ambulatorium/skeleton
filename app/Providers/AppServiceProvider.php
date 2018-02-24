<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting\Speciality\Speciality;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('*', function ($view) {
            $specialities = \Cache::rememberForever('specialities', function () {
                return Speciality::all();
            });

            $view->with('specialities', $specialities);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
