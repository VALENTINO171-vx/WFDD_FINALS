<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!session()->has('user_id')) {
            return redirect('/login')->with('error', 'Please login first');
        }

        // Check if user has admin role and redirect to admin panel
        if (session()->has('user_role') && strtolower(session('user_role')) === 'admin') {
            if (!str_starts_with($request->path(), 'admin')) {
                return redirect('/admin');
            }
        }

        return $next($request);
    }
}
