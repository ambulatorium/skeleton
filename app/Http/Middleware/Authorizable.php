<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authorizable
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $role = null, $permission = null)
    {
        if (Auth::guest()) {
            return redirect()->route('/');
        }

        if ($role != null) {
            if (! $request->user()->hasAnyRole(explode('|', $role))) {
                abort(403);
            }
        }

        if ($permission != null) {
            if (! $request->user()->can($permission)) {
                abort(403);
            }
        }

        return $next($request);
    }
}
