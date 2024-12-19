<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel cache.
     */
    public function up(): void
    {
        // Membuat tabel cache
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();  // Kunci cache sebagai primary key
            $table->mediumText('value');  // Nilai cache
            $table->integer('expiration');  // Waktu kedaluwarsa cache
        });

        // Membuat tabel cache_locks
        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();  // Kunci lock cache
            $table->string('owner');  // Pemilik lock
            $table->integer('expiration');  // Waktu kedaluwarsa lock
        });
    }

    /**
     * Membalikkan migrasi dan menghapus tabel.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
