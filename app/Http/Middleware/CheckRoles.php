<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Route;

class CheckRoles
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @param  string  $roles
   * @return mixed
   */
  public function handle($request, Closure $next, $roles)
  {
    if (!$request->user()->hasAnyRole($roles)) {
      dd($request->user()->getRoleNames()->implode('|'), $roles, Route::currentRouteName(), 'Veuillez montrer ce message aux informaticiens s\'il vous plait. Merci');
    }
    return $next($request);
  }
}
