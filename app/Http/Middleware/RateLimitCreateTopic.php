<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Routing\Middleware\ThrottleRequests;

class RateLimitCreateTopic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = auth()->id();
        $maxAttempts = 10; // Maximum number of attempts
        $decayMinutes = 10; // The time frame in minutes

        if (RateLimiter::tooManyAttempts($userId, $maxAttempts, $decayMinutes)) {
            $secondsUntilNextAttempt = RateLimiter::availableIn($userId);
            return back()->with('error', "You have exceeded the rate limit. Please wait {$secondsUntilNextAttempt} seconds before trying again.");
        }

        // Increment the rate limiter counter
        RateLimiter::hit($userId);

        return $next($request);
    }
}
