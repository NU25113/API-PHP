<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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

        if (auth()->check() && $request->user()->roles == 'admin') {
            return $next($request);
        }
        return response()->json([
            'message' => 'เฉพาะ Admin เท่านั้น'
        ], 403);

    }
}
