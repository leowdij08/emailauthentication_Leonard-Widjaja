<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Menambahkan kolom 'role' pada tabel 'users' untuk menentukan peran pengguna
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'librarian', 'student', 'lecturer'])->default('admin'); // Peran pengguna dapat berupa admin, librarian, student, atau lecturer
        });
    }

    public function down(): void
    {
        // Menghapus kolom 'role' dari tabel 'users'
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
