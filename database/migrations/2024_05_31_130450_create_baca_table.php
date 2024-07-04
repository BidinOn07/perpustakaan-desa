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
        Schema::create('baca', function (Blueprint $table) {
            $table->id();
            $table->integer('pembaca')->nullable ();
            $table->date('tanggal_pinjam');
            $table->unsignedBigInteger('buku_id'); // Kolom kunci asing
            $table->foreign('buku_id')->references('id')->on('bukus')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('kategori_id')->nullable(); // Kolom kunci asing
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baca');
    }
};
