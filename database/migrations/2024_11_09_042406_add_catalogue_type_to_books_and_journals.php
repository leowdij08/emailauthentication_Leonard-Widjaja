<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCatalogueTypeToBooksAndJournals extends Migration
{
    /**
     * Menjalankan migrasi untuk menambahkan kolom catalogue_type.
     */
    public function up()
    {
        // Menambahkan kolom catalogue_type pada tabel books
        Schema::table('books', function (Blueprint $table) {
            $table->string('catalogue_type')->default('book');
        });

        // Menambahkan kolom catalogue_type pada tabel journals
        Schema::table('journals', function (Blueprint $table) {
            $table->string('catalogue_type')->default('journal');
        });
    }

    /**
     * Membalikkan migrasi dan menghapus kolom catalogue_type.
     */
    public function down()
    {
        // Menghapus kolom catalogue_type pada tabel books
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('catalogue_type');
        });

        // Menghapus kolom catalogue_type pada tabel journals
        Schema::table('journals', function (Blueprint $table) {
            $table->dropColumn('catalogue_type');
        });
    }
};
