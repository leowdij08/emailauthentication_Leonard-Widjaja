<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan tampilan registrasi pengguna.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Menangani permintaan registrasi pengguna.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Membuat pengguna baru dan menyimpan data pengguna
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Mengirimkan event bahwa pengguna telah terdaftar
        event(new Registered($user));

        // Validasi input untuk login setelah registrasi
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Mencoba untuk login pengguna setelah registrasi
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            
            // Pengalihan berdasarkan peran pengguna
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'librarian') {
                return redirect()->route('librarian.dashboard');
            } elseif ($user->role == 'student') {
                return redirect()->route('student.dashboard');
            } else {
                return redirect()->route('lecturer.dashboard');
            }
        }

        // Jika login gagal, kembalikan dengan pesan error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
