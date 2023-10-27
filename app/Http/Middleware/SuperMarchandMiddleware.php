<?php

namespace App\Http\Middleware;

use Closure;

class SuperMarchandMiddleware
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
        if ($request->user() && $request->user()->hasRole(config('custom.roles.smarchand'))){
            return $next($request);
        }
        else {
            return redirect('/');
        }
    }
}
