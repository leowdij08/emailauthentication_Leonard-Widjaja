<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Kirim notifikasi verifikasi email baru
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) { // Cek apakah email sudah terverifikasi
            return redirect()->intended(route('dashboard', absolute: false)); // Redirect ke dashboard jika sudah terverifikasi
        }

        $request->user()->sendEmailVerificationNotification(); // Kirim email verifikasi

        return back()->with('status', 'verification-link-sent'); // Kembalikan status bahwa link verifikasi sudah dikirim
    }
}
