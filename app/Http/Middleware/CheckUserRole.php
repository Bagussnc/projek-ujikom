<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->user_hak === $role) {
            return $next($request);
        }

        return redirect('/login')->withErrors(['accessError' => 'Akses ditolak!']);
    }
}
