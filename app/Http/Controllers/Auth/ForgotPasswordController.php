<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Menampilkan halaman formulir untuk meminta link reset password.
     */
    public function create()
    {
        return view('pages.auth.password.email');
    }

    /**
     * Menangani pengiriman link reset password ke email pengguna.
     */
    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Mencoba mengirim link reset
        $status = Password::sendResetLink($request->only('email'));

        // Memberikan respon berdasarkan hasil pengiriman email
        return $status == Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }
}