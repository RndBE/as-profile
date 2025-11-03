<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('nama_projek')->nullable();
            $table->string('slug')->nullable();
            $table->foreignId('clients_id')->constrained('clients')->onUpdate('cascade');
            $table->string('kategori_projek')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('url')->nullable();
            $table->integer('tahun')->nullable();
            $table->string('white_paper')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
