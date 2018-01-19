<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Appointment\Appointment' =>'App\Policies\AppointmentPolicy',
        'App\Models\Doctor\Doctor'           =>'App\Policies\DoctorPolicy',
        'App\Models\Doctor\Schedule'         =>'App\Policies\SchedulePolicy',
        'App\Models\Setting\Group\Group'     =>'App\Policies\GroupPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
