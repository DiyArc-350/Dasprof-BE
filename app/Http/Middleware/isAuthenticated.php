<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $guards = empty($guards) ? [null] : $guards;
        foreach ($guards as $guard) {
            switch ($guard) {
                case 'null':
                    if (Auth::guard($guard)->check())
                        return redirect()->route('user.login.page');
                    break;
                case 'web':
                    if (Auth::guard($guard)->check())
                        return redirect()->route('dashboard');
                    break;
            }
        }
        return $next($request);
    }
}
