<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Memperbarui password pengguna.
     */
    public function update(Request $request): RedirectResponse
    {
        // Validasi untuk password saat ini dan password baru
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // Mengupdate password pengguna yang sudah tervalidasi
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Mengembalikan response dengan status 'password-updated'
        return back()->with('status', 'password-updated');
    }
}
