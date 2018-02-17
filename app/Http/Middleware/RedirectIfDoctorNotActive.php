<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfDoctorNotActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        if ($user->doctor->is_active) {
            return $next($request);
        }

        flash('Sorry, you do not have permission to create schedule yet.
        Please complete your profile as a doctor and create schedule again. 
        <p><a href="/user/settings/profile/doctor">AGREE</a></p>')->important();

        return redirect(route('schedules.index'));
    }
}
