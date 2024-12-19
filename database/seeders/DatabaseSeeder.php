<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            BooksSeeder::class, // Memanggil seeder untuk buku
            JournalSeeder::class, // Memanggil seeder untuk jurnal
            CDSeeder::class, // Memanggil seeder untuk CD
            NewspaperSeeder::class, // Memanggil seeder untuk surat kabar
            FinalYearProjectSeeder::class, // Memanggil seeder untuk proyek akhir tahun
        ]);
    }
}
