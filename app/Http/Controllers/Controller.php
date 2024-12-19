<?php

namespace App\Http\Controllers;

// Import trait untuk otorisasi
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// Import trait untuk validasi
use Illuminate\Foundation\Validation\ValidatesRequests;
// Import class dasar Controller dari Laravel
use Illuminate\Routing\Controller as BaseController;

// Definisi kelas Controller sebagai abstract class
abstract class Controller extends BaseController
{
    // Menggunakan trait AuthorizesRequests untuk otorisasi
    use AuthorizesRequests;
    // Menggunakan trait ValidatesRequests untuk validasi request
    use ValidatesRequests;
}
