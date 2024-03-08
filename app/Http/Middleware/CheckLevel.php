<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $level)
    {
        info('Inside CheckLevel middleware', ['user' => Auth::user(), 'level' => $level]);
    
        if (Auth::check() && Auth::user()->level == $level) {
            return $next($request);
        }
    
        return redirect('/unauthorized');
    }
}
