<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Tampilkan prompt verifikasi email
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user()->hasVerifiedEmail() // Cek apakah email sudah terverifikasi
                    ? redirect()->intended(route('dashboard', absolute: false)) // Redirect ke dashboard jika sudah terverifikasi
                    : view('auth.verify-email'); // Tampilkan halaman verifikasi email jika belum terverifikasi
    }
}
