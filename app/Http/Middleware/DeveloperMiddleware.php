<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;


class DeveloperMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		if(!Auth::user()->isDeveloper()) {
			if($request->ajax() || $request->wantsJson()) {
				return response('Unauthorized.', 401);
			}
			else {
				return new Response(view('errors.403'));
			}
		}

		return $next($request);
	}
}
