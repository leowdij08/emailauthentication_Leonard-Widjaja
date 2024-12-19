<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |----------------------------------------------------------------------
    | Email Verification Controller
    |----------------------------------------------------------------------
    |
    | Controller ini menangani verifikasi email untuk pengguna yang baru
    | mendaftar dan juga memungkinkan pengiriman ulang email verifikasi jika
    | pengguna tidak menerima email asli.
    |
    */

    use VerifiesEmails;

    /**
     * Tempat untuk mengarahkan pengguna setelah verifikasi email.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Membuat instance controller baru.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');  // Hanya pengguna yang sudah terautentikasi yang dapat mengakses
        $this->middleware('signed')->only('verify');  // Verifikasi hanya berlaku untuk pengguna dengan URL yang sah
        $this->middleware('throttle:6,1')->only('verify', 'resend');  // Pembatasan untuk jumlah percakapan verifikasi per menit
    }
}
