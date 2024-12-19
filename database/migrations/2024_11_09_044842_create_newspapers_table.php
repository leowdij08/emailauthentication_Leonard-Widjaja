<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Membuat tabel 'newspapers' untuk menyimpan data surat kabar
        Schema::create('newspapers', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom id sebagai primary key
            $table->string('title'); // Menambahkan kolom title untuk judul surat kabar
            $table->string('author'); // Menambahkan kolom author untuk penulis surat kabar
            $table->string('publisher'); // Menambahkan kolom publisher untuk penerbit surat kabar
            $table->text('description'); // Menambahkan kolom description untuk deskripsi surat kabar
            $table->bigInteger('price')->default(0); // Menambahkan kolom price untuk harga surat kabar, dengan default 0
            $table->integer('stock')->default(0); // Menambahkan kolom stock untuk jumlah stok surat kabar, dengan default 0
            $table->date('datePublished'); // Menambahkan kolom datePublished untuk tanggal penerbitan
            $table->text('onlineLink'); // Menambahkan kolom onlineLink untuk link online surat kabar
            $table->string('catalogue_type')->default('newspaper'); // Menambahkan kolom catalogue_type untuk menentukan tipe katalog, default 'newspaper'
        });
    }

    public function down(): void
    {
        // Menghapus tabel 'newspapers' jika dibutuhkan
        Schema::dropIfExists('newspapers');
    }
};
