<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles  Parameter ini akan menangkap semua peran yang diizinkan (misal: 'admin', 'manager').
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Periksa apakah pengguna sudah login. Jika belum, middleware 'auth'
        //    seharusnya sudah mengarahkannya ke halaman login.
        //    Pengecekan ini adalah lapisan keamanan tambahan.
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Ambil peran dari pengguna yang sedang login.
        $userRole = Auth::user()->role;

        // 3. Periksa apakah peran pengguna ada di dalam daftar peran yang diizinkan ($roles).
        if (in_array($userRole, $roles)) {
            // 4. Jika diizinkan, lanjutkan permintaan ke Controller.
            return $next($request);
        }

        // 5. Jika tidak diizinkan, hentikan permintaan dan tampilkan halaman error 403 (Forbidden).
        abort(403, 'UNAUTHORIZED ACTION.');
    }
}