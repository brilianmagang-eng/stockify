<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman form login.
     */
    public function create()
    {
        return view('pages.auth.login');
    }

    /**
     * Menangani proses upaya login dengan redirect berdasarkan peran.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba lakukan login
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // 3. Periksa peran pengguna dan arahkan ke dashboard yang sesuai
            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($user->role === 'manager') {
                // Arahkan ke dashboard manager (saat nanti dibuat)
                // return redirect()->intended(route('manager.dashboard'));
                return redirect()->intended(route('admin.dashboard')); // Sementara ke admin dulu
            } elseif ($user->role === 'staff') {
                // Arahkan ke dashboard staff (saat nanti dibuat)
                // return redirect()->intended(route('staff.dashboard'));
                return redirect()->intended(route('admin.dashboard')); // Sementara ke admin dulu
            }

            // Fallback jika role tidak terdefinisi (seharusnya tidak terjadi)
            return redirect('/');
        }

        // 4. Jika gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Menangani proses logout.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}