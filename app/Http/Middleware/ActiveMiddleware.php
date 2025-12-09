<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ActiveMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->is_active == false) {
            Auth::logout();
            return redirect('/login')->with('error', 'Akun kamu dinonaktifkan.');
        }

        return $next($request);
    }
}
