<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
	/**
	 * Get the path the user should be redirected to when they are not authenticated.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return string|null
	 */
		public function handle($request, Closure $next, ...$guards) {
				
			if (Auth::check()) {
				return $next($request);
			}
			\Session::put('isLogin',1);
			return redirect()->route('index');
		}
}
