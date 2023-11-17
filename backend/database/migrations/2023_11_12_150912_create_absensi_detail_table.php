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
        Schema::create('absensi_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('absensi_id')->constrained('absensi');
            $table->foreignId('manajemen_kelas_id')->constrained('manajemen_kelas');
            $table->foreignId('siswa_id')->constrained('siswa');
            $table->enum('kehadiran', ['Hadir', 'Sakit', 'Izin', 'Alfa']);
            $table->string('catatan')->nullable();
            $table->date('tgl_absen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_detail');
    }
};
