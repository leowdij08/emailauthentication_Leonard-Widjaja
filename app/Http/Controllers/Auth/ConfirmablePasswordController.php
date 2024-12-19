<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController extends Controller
{
    /**
     * Tampilkan tampilan konfirmasi password
     */
    public function show(): View
    {
        return view('auth.confirm-password');
    }

    /**
     * Konfirmasi password pengguna
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email, // Memastikan email pengguna sesuai
            'password' => $request->password, // Memastikan password sesuai
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'), // Jika password salah, lemparkan pesan error
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time()); // Simpan waktu konfirmasi password

        return redirect()->intended(route('dashboard', absolute: false)); // Redirect ke halaman yang dimaksud
    }
}
