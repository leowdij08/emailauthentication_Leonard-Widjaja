<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @param  Request  $request
     * @return View
     */
    public function edit(Request $request): View
    {
        // Menampilkan halaman edit profil dengan data pengguna saat ini
        return view('profile.edit', [
            'user' => $request->user(), // Mengambil data pengguna yang sedang login
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param  ProfileUpdateRequest  $request
     * @return RedirectResponse
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Mengisi data pengguna dengan data yang sudah divalidasi
        $request->user()->fill($request->validated());

        // Memeriksa apakah ada perubahan pada email
        if ($request->user()->isDirty('email')) {
            // Jika email berubah, set ulang waktu verifikasi email
            $request->user()->email_verified_at = null;
        }

        // Menyimpan perubahan profil
        $request->user()->save();

        // Mengarahkan kembali ke halaman edit profil dengan status pembaruan
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Memvalidasi password untuk memastikan pengguna yang menghapus akun adalah pemilik akun
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'], // Memastikan password yang dimasukkan adalah password yang benar
        ]);

        $user = $request->user(); // Mendapatkan data pengguna yang sedang login

        Auth::logout(); // Melakukan logout setelah penghapusan akun

        $user->delete(); // Menghapus akun pengguna dari database

        // Menyegarkan sesi setelah penghapusan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Mengarahkan pengguna ke halaman utama setelah penghapusan akun
        return Redirect::to('/');
    }
}
