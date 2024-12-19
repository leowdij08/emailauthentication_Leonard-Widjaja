<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Membuat tabel 'borrowed_items' untuk menyimpan data item yang dipinjam
        Schema::create('borrowed_items', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom id sebagai primary key
            $table->unsignedBigInteger('borrower_id');  // Kolom borrower_id untuk siapa yang meminjam (librarian atau student)
            $table->unsignedBigInteger('borrowable_id');  // Kolom borrowable_id untuk ID item yang dipinjam (misal buku, jurnal, dll.)
            $table->string('borrowable_type');  // Kolom borrowable_type untuk jenis item yang dipinjam (misal Book, Journal, dll.)
            $table->date('borrowed_at');  // Kolom borrowed_at untuk tanggal peminjaman
            $table->date('due_date');  // Kolom due_date untuk tanggal pengembalian item
            $table->timestamps();  // Kolom timestamps untuk created_at dan updated_at

            // Menambahkan foreign key pada borrower_id untuk menghubungkan ke tabel users
            $table->foreign('borrower_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        // Menghapus tabel 'borrowed_items' jika dibutuhkan
        Schema::dropIfExists('borrowed_items');
    }
};
