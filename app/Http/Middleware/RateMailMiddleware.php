<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class RateMailMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $customerId = $request->route('customer')->id;

        if (RateLimiter::tooManyAttempts($customerId, 20)) {
            return back()->with('danger', 'Has alcanzado el límite de intentos este mes.');
        }

        RateLimiter::hit($customerId, 60 * 24 * 30);

        return $next($request);
    }
}
