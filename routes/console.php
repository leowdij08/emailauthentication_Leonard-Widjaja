<?php

use Illuminate\Foundation\Inspiring; // Mengimpor kelas Inspiring untuk menyediakan kutipan motivasi.
use Illuminate\Support\Facades\Artisan; // Mengimpor kelas Artisan untuk mendefinisikan perintah Artisan.

// Mendefinisikan perintah Artisan bernama 'inspire'.
// Ketika perintah ini dijalankan, akan menampilkan sebuah kutipan motivasi menggunakan Inspiring::quote().
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote()); // Menambahkan komentar yang berisi kutipan motivasi.
})->purpose('Display an inspiring quote') // Memberikan deskripsi singkat tentang tujuan perintah ini.
  ->hourly(); // Menjadwalkan agar perintah ini dapat dijalankan setiap jam (opsional, bergantung pada scheduler).
