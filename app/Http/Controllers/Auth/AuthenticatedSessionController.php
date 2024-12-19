<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan tampilan login
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Menangani permintaan otentikasi pengguna
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate(); // Melakukan otentikasi pengguna

        $request->session()->regenerate(); // Regenerasi session untuk mencegah session fixation attack

        // Redirect berdasarkan peran pengguna (admin, pustakawan, mahasiswa, atau dosen)
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->role == 'librarian') {
            return redirect()->route('librarian.dashboard');
        } elseif (Auth::user()->role == 'student') {
            return redirect()->route('student.dashboard');
        } elseif (Auth::user()->role == 'general') {
            return redirect()->route('general.dashboard');
        } else {
            return redirect()->route('lecturer.dashboard');
        }
    }

    /**
     * Hapus sesi otentikasi pengguna yang sudah login
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout(); // Logout pengguna

        $request->session()->invalidate(); // Invalidasi sesi

        $request->session()->regenerateToken(); // Regenerasi token CSRF

        return redirect('/'); // Redirect ke halaman utama
    }
}
