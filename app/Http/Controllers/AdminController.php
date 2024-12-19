<?php

namespace App\Http\Controllers; // Namespace untuk file ini agar sesuai dengan struktur aplikasi Laravel

use App\Models\User; // Impor model User untuk digunakan dalam pengambilan data dari database

class AdminController extends Controller
{
    // Fungsi untuk menampilkan halaman dashboard admin
    public function dashboard()
    {
        // Mengambil semua pengguna dengan peran 'librarian' dari database
        $librarians = User::where('role', 'librarian')->get();

        // Mengirim data 'librarians' ke view 'admin.dashboard'
        return view('admin.dashboard', compact('librarians'));
    }
}
