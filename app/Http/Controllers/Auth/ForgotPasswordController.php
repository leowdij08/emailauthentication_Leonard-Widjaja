<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |----------------------------------------------------------------------
    | Password Reset Controller
    |----------------------------------------------------------------------
    |
    | Controller ini bertanggung jawab untuk menangani pengiriman email reset
    | password kepada pengguna yang lupa password mereka.
    |
    */

    use SendsPasswordResetEmails;
}
