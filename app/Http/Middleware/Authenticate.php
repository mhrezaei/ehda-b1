<?php

namespace App\Http\Middleware;

use App\Events\VolunteerClick;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest() or Auth::user()->volunteer_status < 8) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect('/login');
            }
        }

        return $next($request);
    }
}
