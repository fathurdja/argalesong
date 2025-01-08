<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class CheckAuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
	$token = Cookie::get('auth_token');

        // Jika token tidak ada, redirect ke halaman login
        if (!$token) {
            return redirect()->route('login')->withErrors(['auth_failed' => 'Silakan login terlebih dahulu.']);
        }

        // Cek apakah token ada di database
        return $next($request);
    }
}
