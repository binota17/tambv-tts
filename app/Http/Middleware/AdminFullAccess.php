<?php

namespace App\Http\Middleware;

use Closure;

class AdminFullAccess
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'full_access') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Bạn không có quyền truy cập.');
    }
}