<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Memeriksa apakah pengguna telah login
    //     if (!Auth::check()) {
    //         return redirect()->route('/auten/login');
    //     }

    //     // Memeriksa apakah peran pengguna cocok dengan peran yang diizinkan
    //     foreach ($roles as $role) {
    //         if (Auth::user()->role === $role) {
    //             return $next($request);
    //         }
    //     }

    //     return abort(403, 'Unauthorized'); // Menolak akses jika peran pengguna tidak sesuai
    }
}
