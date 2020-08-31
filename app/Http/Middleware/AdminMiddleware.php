<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
			if (Auth::check() && Auth::user()->type == 0 && Auth::user()->email_verified == 1) {
				return $next($request);
			} else {
				  return 'logout';
			}
			
			return redirect('logout');
        /*return response([

            'error' => [
                'code' => 'INSUFFICIENT_ROLE',
                'description' => 'You are not authorized to access this resource.'
            ]
        ], 401);*/

    }
}
