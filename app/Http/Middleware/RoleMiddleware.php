<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next, string $role): Response
	{
		if (!$request->user()->hasRole($role)) {
			return redirect()->route('home')->withErrors(__('auth.not_authorized'));
		}

		return $next($request);
	}
}
