<?php

namespace App\Http\Middleware;

use Closure;

class DirectionMiddleware
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
        if ($request->user() && $request->user()->hasRole(config('custom.roles.direction'))){
            return $next($request);
        }
        else {
            return redirect('/');
        }
    }
}
