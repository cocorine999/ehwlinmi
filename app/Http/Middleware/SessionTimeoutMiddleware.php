<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Carbon\Carbon;

class SessionTimeoutMiddleware
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
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::guard()->user();
        $now = Carbon::now();
        $last_seen = Carbon::parse($user->last_seen_at);
        $absence = $now->diffInMinutes($last_seen);

        // If user has been inactivity longer than the allowed inactivity period
        if ($absence > 15) { // 15 min
            Auth::guard()->logout();
            $request->session()->invalidate();
            
            toastr()->error('Longue periode d\'inactivité');
            return redirect()->route('login');

            #return $next($request);
        }

        $user->last_seen_at = $now->format('Y-m-d H:i:s');
        $user->save();

        return $next($request);
    }
}
