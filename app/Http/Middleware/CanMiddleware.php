<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class CanMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
	 * @return mixed
	 */
	public function handle($request, Closure $next , $permit , $domain=null)
	{
		if(!Auth::user()->can($permit,$domain)) {
			if($request->ajax() || $request->wantsJson()) {
				return response('Unauthorized.', 401);
			}
			else {
				return view('errors.403');
			}
		}

		return $next($request);
	}
}
