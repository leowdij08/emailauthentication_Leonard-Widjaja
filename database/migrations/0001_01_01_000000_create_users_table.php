<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel yang diperlukan.
     */
    public function up(): void
    {
        // Membuat tabel users
        Schema::create('users', function (Blueprint $table) {
            $table->id();  // ID pengguna
            $table->string('name');  // Nama pengguna
            $table->string('email')->unique();  // Email pengguna yang harus unik
            $table->timestamp('email_verified_at')->nullable();  // Timestamp untuk verifikasi email
            $table->string('password');  // Password pengguna
            $table->rememberToken();  // Token untuk mengingat sesi pengguna
            $table->timestamps();  // Kolom timestamps (created_at, updated_at)
        });

        // Membuat tabel password_reset_tokens
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();  // Email sebagai primary key
            $table->string('token');  // Token untuk reset password
            $table->timestamp('created_at')->nullable();  // Timestamp untuk pembuatan token
        });

        // Membuat tabel sessions
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();  // ID session
            $table->foreignId('user_id')->nullable()->index();  // ID pengguna (foreign key)
            $table->string('ip_address', 45)->nullable();  // Alamat IP pengguna
            $table->text('user_agent')->nullable();  // User agent
            $table->longText('payload');  // Data payload session
            $table->integer('last_activity')->index();  // Timestamp untuk aktivitas terakhir
        });
    }

    /**
     * Membalikkan migrasi dan menghapus tabel.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
