<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // dd(route('auth#registerPage'));
        // dd(url()->current());

        if (!empty(Auth::user())) {

            if (url()->current() == route('auth#loginPage') || url()->current() == route('auth#registerPage')) {
                return back();
            }

            if (Auth::user()->role == 'user') {
                return back();
            }

            return $next($request);
        }


        return $next($request);
    }
}
