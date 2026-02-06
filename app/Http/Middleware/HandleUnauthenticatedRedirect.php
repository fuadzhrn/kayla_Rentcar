<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleUnauthenticatedRedirect
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
        // Check if user is unauthenticated
        if (!auth()->check() && $request->is('admin/*')) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu untuk mengakses area admin.');
        }

        return $next($request);
    }
}
