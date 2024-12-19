<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Membuat tabel 'c_d_s' untuk menyimpan data CD
        Schema::create('c_d_s', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom id sebagai primary key
            $table->string('title'); // Menambahkan kolom title untuk judul CD
            $table->string('author'); // Menambahkan kolom author untuk penulis atau pembuat CD
            $table->string('publisher'); // Menambahkan kolom publisher untuk penerbit CD
            $table->text('description'); // Menambahkan kolom description untuk deskripsi CD
            $table->bigInteger('price')->default(0); // Menambahkan kolom price untuk harga CD, dengan default 0
            $table->integer('stock')->default(0); // Menambahkan kolom stock untuk jumlah stok CD, dengan default 0
            $table->date('datePublished'); // Menambahkan kolom datePublished untuk tanggal penerbitan
            $table->enum('genre', ['fiction', 'nonfiction', 'fantasy', 'mystery', 'science_fiction', 'biography', 'rock', 'jazz', 'pop']); // Menambahkan kolom genre untuk jenis CD
            $table->text('onlineLink'); // Menambahkan kolom onlineLink untuk link online CD
            $table->string('catalogue_type')->default('CD'); // Menambahkan kolom catalogue_type untuk menentukan tipe katalog, default 'CD'
        });
    }

    public function down(): void
    {
        // Menghapus tabel 'c_d_s' jika dibutuhkan
        Schema::dropIfExists('c_d_s');
    }
};
