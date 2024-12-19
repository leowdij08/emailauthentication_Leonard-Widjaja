<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel pekerjaan dan batch pekerjaan.
     */
    public function up(): void
    {
        // Membuat tabel jobs untuk menyimpan antrian pekerjaan
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();  // ID pekerjaan
            $table->string('queue')->index();  // Nama antrian pekerjaan
            $table->longText('payload');  // Data pekerjaan
            $table->unsignedTinyInteger('attempts');  // Jumlah percobaan pekerjaan
            $table->unsignedInteger('reserved_at')->nullable();  // Waktu saat pekerjaan dikunci
            $table->unsignedInteger('available_at');  // Waktu saat pekerjaan tersedia
            $table->unsignedInteger('created_at');  // Waktu saat pekerjaan dibuat
        });

        // Membuat tabel job_batches untuk batch pekerjaan
        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();  // ID batch pekerjaan
            $table->string('name');  // Nama batch pekerjaan
            $table->integer('total_jobs');  // Total pekerjaan dalam batch
            $table->integer('pending_jobs');  // Pekerjaan yang tertunda
            $table->integer('failed_jobs');  // Pekerjaan yang gagal
            $table->longText('failed_job_ids');  // ID pekerjaan yang gagal
            $table->mediumText('options')->nullable();  // Opsi untuk batch
            $table->integer('cancelled_at')->nullable();  // Waktu pembatalan batch
            $table->integer('created_at');  // Waktu saat batch dibuat
            $table->integer('finished_at')->nullable();  // Waktu selesai batch
        });

        // Membuat tabel failed_jobs untuk pekerjaan yang gagal
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();  // ID pekerjaan gagal
            $table->string('uuid')->unique();  // UUID untuk pekerjaan gagal
            $table->text('connection');  // Koneksi yang digunakan
            $table->text('queue');  // Antrian pekerjaan
            $table->longText('payload');  // Data pekerjaan
            $table->longText('exception');  // Rincian pengecualian
            $table->timestamp('failed_at')->useCurrent();  // Waktu saat pekerjaan gagal
        });
    }

    /**
     * Membalikkan migrasi dan menghapus tabel.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};
