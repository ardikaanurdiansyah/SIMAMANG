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
        Schema::create('peserta_magangs', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->string('asal_instansi');
    $table->string('jurusan');
    $table->string('no_hp');
    $table->string('email')->nullable();

    $table->foreignId('divisi_id')->constrained('divisis')->onDelete('cascade');

    $table->date('tanggal_mulai');
    $table->date('tanggal_selesai');

    $table->enum('status', ['Aktif', 'Selesai'])->default('Aktif');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_magangs');
    }
};
