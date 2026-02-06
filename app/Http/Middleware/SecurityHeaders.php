<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Prevent clickjacking attacks - allow iframes from trusted sources
        $response->header('X-Frame-Options', 'SAMEORIGIN');
        
        // Prevent MIME type sniffing
        $response->header('X-Content-Type-Options', 'nosniff');
        
        // Enable XSS protection
        $response->header('X-XSS-Protection', '1; mode=block');
        
        // Content Security Policy - prevent script injection, allow iframes from maps services
        $response->header('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://fonts.googleapis.com; style-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com; img-src 'self' data: https:; connect-src 'self'; frame-src 'self' https://www.openstreetmap.org https://*.google.com https://maps.googleapis.com");
        
        // Referrer Policy
        $response->header('Referrer-Policy', 'strict-origin-when-cross-origin');
        
        // Permissions Policy
        $response->header('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');

        return $response;
    }
}
