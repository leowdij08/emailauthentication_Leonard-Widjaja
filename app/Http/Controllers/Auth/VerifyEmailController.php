<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Menandai alamat email pengguna yang terautentikasi sebagai terverifikasi.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Memeriksa apakah email sudah terverifikasi
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        }

        // Menandai email sebagai terverifikasi dan mengirimkan event Verified
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // Mengarahkan pengguna setelah verifikasi email berhasil
        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }
}
