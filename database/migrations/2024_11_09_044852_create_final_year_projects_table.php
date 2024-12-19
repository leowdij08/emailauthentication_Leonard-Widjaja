<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Membuat tabel 'final_year_projects' untuk menyimpan data proyek akhir tahun
        Schema::create('final_year_projects', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom id sebagai primary key
            $table->string('title', 255); // Menambahkan kolom title untuk judul proyek
            $table->string('author', 255); // Menambahkan kolom author untuk penulis proyek
            $table->string('university', 255); // Menambahkan kolom university untuk nama universitas
            $table->text('abstract')->nullable(); // Menambahkan kolom abstract untuk abstrak proyek (opsional)
            $table->unsignedInteger('available_copies')->default(0); // Menambahkan kolom available_copies untuk jumlah salinan yang tersedia
            $table->date('publication_date'); // Menambahkan kolom publication_date untuk tanggal publikasi proyek
            $table->string('project_url', 512)->nullable(); // Menambahkan kolom project_url untuk URL proyek (opsional)
            $table->string('project_type')->default('final year project'); // Menambahkan kolom project_type untuk jenis proyek, default 'final year project'
            $table->timestamps(); // Menambahkan kolom timestamps untuk created_at dan updated_at
        });
    }

    public function down(): void
    {
        // Menghapus tabel 'final_year_projects' jika dibutuhkan
        Schema::dropIfExists('final_year_projects');
    }
};
