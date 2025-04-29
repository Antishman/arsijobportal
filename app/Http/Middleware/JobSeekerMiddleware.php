<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobSeekerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, \Closure $next) {
        if (auth()->check() && auth()->user()->role === 'jobseeker') {
            return $next($request);
        }
        abort(403, 'Unauthorized');
    }
}
