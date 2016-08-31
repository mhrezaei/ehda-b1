<?php

namespace App\Http\Middleware;

use App\Events\VolunteerClick;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class MembersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest() or Auth::user()->card_status < 8) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect('/login');
            }
        }

//        Event::fire(new VolunteerClick() );
        return $next($request);
    }
}
