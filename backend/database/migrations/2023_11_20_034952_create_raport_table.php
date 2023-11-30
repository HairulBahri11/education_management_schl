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
        Schema::create('raport', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas');
            $table->foreignId('siswa_id')->constrained('siswa');
            $table->foreignId('program_id')->constrained('programs');
            $table->foreignId('pengajar_id')->constrained('users');
            $table->integer('total_nilai');
            $table->year('awal_tahun_ajaran');
            $table->year('akhir_tahun_ajaran');
            $table->longText('topik_aktifitas');
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raport');
    }
};
