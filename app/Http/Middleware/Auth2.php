<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Auth2
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
        if ($request->session()->has('Logged_in') && $request->session('Logged_in') != '' ) {
            return redirect('/');
        }

        return $next($request);
    }
}
