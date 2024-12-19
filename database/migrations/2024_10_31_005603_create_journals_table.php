<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('author', 255);
            $table->string('publisher', 255);
            $table->text('abstract')->nullable();
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedInteger('available_copies')->default(0);
            $table->date('release_date');
            $table->unsignedSmallInteger('volume');
            $table->unsignedSmallInteger('issue');
            $table->unsignedSmallInteger('part')->nullable();
            $table->string('access_url', 512)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journals');
    }
};
