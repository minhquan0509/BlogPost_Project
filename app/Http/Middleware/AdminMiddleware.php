<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // role_as = 1 is admin , 0 is normal user
            if (Auth::user()->role_as == '1') {
                return $next($request);
            } else {
                return redirect('/home')->with('status', 'Acccess Denied! Because you are not the Admin');
            }
        } else {
            return redirect('/login')->with('status', 'Please login first');
        }
    }
}
