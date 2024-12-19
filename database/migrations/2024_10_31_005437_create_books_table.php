<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel buku.
     */
    public function up(): void
    {
        // Membuat tabel books untuk buku
        Schema::create('books', function (Blueprint $table) {
            $table->id();  // ID buku
            $table->string('title', 255);  // Judul buku
            $table->string('author', 255);  // Penulis buku
            $table->string('publisher', 255);  // Penerbit buku
            $table->text('description')->nullable();  // Deskripsi buku
            $table->unsignedBigInteger('price')->default(0);  // Harga buku
            $table->unsignedInteger('stock')->default(0);  // Stok buku
            $table->date('published_date');  // Tanggal terbit buku
            $table->enum('category', ['classic', 'adventure', 'philosophy', 'science', 'history', 'technology', 'psychology']);  // Kategori buku
            $table->string('purchase_link', 512)->nullable();  // Link pembelian buku
            $table->timestamps();  // Kolom timestamps (created_at, updated_at)
        });
    }

    /**
     * Membalikkan migrasi dan menghapus tabel.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
