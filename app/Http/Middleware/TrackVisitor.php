<?php

namespace App\Http\Middleware;

use App\Models\SiteVisit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Catat kunjungan unik per IP per hari.
     * Jika IP yang sama sudah tercatat hari ini, skip (tidak double count).
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Hanya catat kunjungan GET (bukan POST form submission dll)
        if ($request->isMethod('GET') && !$request->ajax()) {
            $ip   = $request->ip();
            $date = today()->toDateString();

            // updateOrCreate agar tidak duplicate (unique ip+date)
            try {
                SiteVisit::firstOrCreate(
                    [
                        'ip_address'   => $ip,
                        'visited_date' => $date,
                    ],
                    [
                        'user_agent' => substr($request->userAgent() ?? '', 0, 512),
                    ]
                );
            } catch (\Throwable $e) {
                // Jangan sampai error tracking merusak halaman utama
                // Silent fail
            }
        }

        return $next($request);
    }
}
