<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |----------------------------------------------------------------------
    | Password Reset Controller
    |----------------------------------------------------------------------
    |
    | Controller ini bertanggung jawab untuk menangani permintaan reset
    | password dan menggunakan trait untuk menambahkan fungsionalitas ini.
    |
    */

    use ResetsPasswords;

    /**
     * Tempat untuk mengarahkan pengguna setelah password mereka direset.
     *
     * @var string
     */
    protected $redirectTo = '/home';
}
