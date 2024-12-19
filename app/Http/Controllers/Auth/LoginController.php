<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |----------------------------------------------------------------------
    | Login Controller
    |----------------------------------------------------------------------
    |
    | Controller ini menangani otentikasi pengguna dan pengalihan ke halaman
    | setelah login. Menggunakan trait untuk menyederhanakan fungsionalitasnya.
    |
    */

    use AuthenticatesUsers;

    /**
     * Redirect pengguna setelah login
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Membuat instance controller baru
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout'); // Hanya pengguna yang belum login yang dapat mengakses
    }

    /**
     * Menangani login pengguna
     */
    public function login(Request $request): RedirectResponse
    {   
        $input = $request->all(); // Ambil semua input dari request
     
        // Validasi input login
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
     
        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) // Coba otentikasi pengguna
        {
            $user = Auth::user(); // Ambil data pengguna yang sedang login

            // Redirect berdasarkan peran pengguna
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else if ($user->role == 'librarian') {
                return redirect()->route('librarian.dashboard');
            } else if ($user->role == 'student') {
                return redirect()->route('student.dashboard');
            } else if ($user->role == 'lecturer') {
                return redirect()->route('lecturer.dashboard');
            } else if ($user->role == 'general') {
                return redirect()->route('general.dashboard'); // Tambahkan route ini
            } else {
                return redirect()->route('home'); // Default jika tidak ada role yang dikenali
            }
        } else {
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.'); // Tampilkan error jika login gagal
        }
    }
}
