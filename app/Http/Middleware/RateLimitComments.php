<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RateLimitComments
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = 'comment:' . $request->ip();

        // Rate limit: 5 komentar per menit per IP
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            Log::warning('Rate limit exceeded for comments', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl(),
                'available_in' => $seconds
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terlalu banyak komentar. Coba lagi dalam ' . ceil($seconds / 60) . ' menit.'
            ], 429);
        }

        RateLimiter::hit($key, 60); // Reset setiap 60 detik

        return $next($request);
    }
}
