<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    /*
    |----------------------------------------------------------------------
    | Confirm Password Controller
    |----------------------------------------------------------------------
    |
    | Controller ini bertanggung jawab untuk menangani konfirmasi password
    | dan menggunakan trait untuk menyertakan fungsionalitas tersebut.
    |
    */

    use ConfirmsPasswords;

    /**
     * Redirect pengguna setelah konfirmasi password gagal
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Membuat instance controller baru
     */
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan hanya pengguna yang sudah login yang dapat mengakses
    }
}
