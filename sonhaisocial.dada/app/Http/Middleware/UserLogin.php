<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserLogin {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {

		if (Auth::Check()) {

			return redirect()->route('home');
			return $next($request);
		}
		return redirect()->route('home')->with('info', 'u must login');

	}
}
