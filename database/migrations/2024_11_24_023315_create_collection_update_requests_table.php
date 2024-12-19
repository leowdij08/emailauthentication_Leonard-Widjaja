<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionUpdateRequestsTable extends Migration
{
    public function up(): void
    {
        // Membuat tabel 'collection_update_requests' untuk menyimpan permintaan pembaruan koleksi
        Schema::create('collection_update_requests', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom id sebagai primary key
            $table->unsignedBigInteger('user_id'); // Kolom user_id untuk siapa yang mengajukan permintaan (librarian)
            $table->string('category'); // Kolom category untuk kategori item yang diminta pembaruan
            $table->unsignedBigInteger('catalogue_id'); // Kolom catalogue_id untuk ID katalog item (misal buku, surat kabar, dll.)
            $table->string('new_title')->nullable(); // Kolom new_title untuk judul baru, jika ada perubahan
            $table->string('new_author')->nullable(); // Kolom new_author untuk penulis baru, jika ada perubahan
            $table->string('new_publisher')->nullable(); // Kolom new_publisher untuk penerbit baru, jika ada perubahan
            $table->date('new_datePublished')->nullable(); // Kolom new_datePublished untuk tanggal terbit baru
            $table->decimal('new_price', 8, 2)->nullable(); // Kolom new_price untuk harga baru
            $table->integer('new_stock')->nullable(); // Kolom new_stock untuk jumlah stok baru
            $table->string('new_onlineLink')->nullable(); // Kolom new_onlineLink untuk link online baru
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Kolom status untuk status permintaan, default 'pending'
            $table->timestamps(); // Menambahkan kolom timestamps untuk created_at dan updated_at
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Menambahkan foreign key pada user_id untuk menghubungkan ke tabel users
        });
    }

    public function down(): void
    {
        // Menghapus tabel 'collection_update_requests' jika dibutuhkan
        Schema::dropIfExists('collection_update_requests');
    }
};
