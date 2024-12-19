<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel jurnal.
     */
    public function up(): void
    {
        // Membuat tabel journals untuk jurnal
        Schema::create('journals', function (Blueprint $table) {
            $table->id();  // ID jurnal
            $table->string('title', 255);  // Judul jurnal
            $table->string('author', 255);  // Penulis jurnal
            $table->string('publisher', 255);  // Penerbit jurnal
            $table->text('abstract')->nullable();  // Abstrak jurnal
            $table->unsignedBigInteger('price')->default(0);  // Harga jurnal
            $table->unsignedInteger('available_copies')->default(0);  // Salinan jurnal yang tersedia
            $table->date('release_date');  // Tanggal rilis jurnal
            $table->unsignedSmallInteger('volume');  // Volume jurnal
            $table->unsignedSmallInteger('issue');  // Edisi jurnal
            $table->unsignedSmallInteger('part')->nullable();  // Bagian jurnal (opsional)
            $table->string('access_url', 512)->nullable();  // URL akses jurnal
            $table->timestamps();  // Kolom timestamps (created_at, updated_at)
        });
    }

    /**
     * Membalikkan migrasi dan menghapus tabel.
     */
    public function down(): void
    {
        Schema::dropIfExists('journals');
    }
};
