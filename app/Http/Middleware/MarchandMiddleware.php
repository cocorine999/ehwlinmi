<?php

namespace App\Http\Middleware;

use Closure;

class MarchandMiddleware
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
        if ($request->user() && $request->user()->hasRole(config('custom.roles.marchand'))){
            return $next($request);
        }
        else {
            return redirect('/');
        }
    }
}
