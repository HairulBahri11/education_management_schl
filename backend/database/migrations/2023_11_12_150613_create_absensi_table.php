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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_id')->constrained('jadwal');
            $table->foreignId('pengajar_id')->constrained('users');
            $table->foreignId('kelas_id')->constrained('kelas');
            $table->date('tgl_absen')->nullable();
            $table->integer('Total_Hadir')->nullable();
            $table->integer('Total_Sakit')->nullable();
            $table->integer('Total_Izin')->nullable();
            $table->integer('Total_Alpa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
