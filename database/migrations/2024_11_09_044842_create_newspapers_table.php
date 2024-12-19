<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('newspapers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->text('description');
            $table->bigInteger('price')->default(0);
            $table->integer('stock')->default(0);
            $table->date('datePublished');
            $table->text('onlineLink');
            $table->string('catalogue_type')->default('newspaper');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('newspapers');
    }
};