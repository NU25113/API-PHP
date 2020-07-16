<?php

namespace App\Http\Middleware;

use Closure;

class DefaultAcceptJson
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
        $request->headers->set('accept', 'application/json', true);

        return $next($request);
    }
}
