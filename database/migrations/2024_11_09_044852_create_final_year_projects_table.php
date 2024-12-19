<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('final_year_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('author', 255);
            $table->string('university', 255);
            $table->text('abstract')->nullable();
            $table->unsignedInteger('available_copies')->default(0);
            $table->date('publication_date');
            $table->string('project_url', 512)->nullable();
            $table->string('project_type')->default('final year project'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('final_year_projects');
    }
};
