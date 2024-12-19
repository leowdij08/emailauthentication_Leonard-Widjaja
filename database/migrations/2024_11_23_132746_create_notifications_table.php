<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up(): void
    {
        // Membuat tabel 'notifications' untuk menyimpan data notifikasi
        Schema::create('notifications', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom id sebagai primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Menambahkan kolom user_id sebagai foreign key yang terhubung ke tabel 'users'
            $table->string('message'); // Menambahkan kolom message untuk isi pesan notifikasi
            $table->boolean('is_read')->default(false); // Menambahkan kolom is_read untuk status apakah notifikasi sudah dibaca, default false
            $table->timestamps(); // Menambahkan kolom timestamps untuk created_at dan updated_at
        });
    }

    public function down(): void
    {
        // Menghapus tabel 'notifications' jika dibutuhkan
        Schema::dropIfExists('notifications');
    }
};
