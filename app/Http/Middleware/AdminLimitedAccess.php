<?php

namespace App\Http\Middleware;

use Closure;

class AdminLimitedAccess
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'limited_access') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Bạn không có quyền truy cập.');
    }
}