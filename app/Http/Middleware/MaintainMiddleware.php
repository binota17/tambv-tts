<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MaintainMiddleware
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
        if (env('APP_MAINTENANCE')) {
            return response()->json(['message' => 'Hệ thống đang trong quá trình bảo trì. Vui lòng quay lại sau.'], 503);
        }

        return $next($request);
    }
}
