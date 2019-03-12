<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard){
            case 'superadmin':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('superadmin.home');
                }
                break;
             case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('admin.home');
                }
                break;
             case 'guru':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('guru.home');
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('siswa.home');
                }
                break;
        }


        return $next($request);
    }
}
