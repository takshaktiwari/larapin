<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Admin
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
        if ( Auth::check() && (!empty(Auth::user()->role->id) && Auth::user()->role->id != '3') )
        {
            return $next($request);
        }

        return redirect('/');
    }
}
