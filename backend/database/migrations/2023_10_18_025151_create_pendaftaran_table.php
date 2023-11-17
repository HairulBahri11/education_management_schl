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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pendaftaran')->unique();
            $table->foreignId('id_orangtua')->constrained('users')->onDelete('cascade');
            $table->string('nama_anak');
            $table->string('asal_sekolah');
            $table->foreignId('id_program')->constrained('programs')->onDelete('cascade');
            $table->enum('status', ['aktif','selesai','mengundurkan-diri']);
            $table->date('tgl_daftar');
            $table->string('bukti_pembayaran');
            $table->string('status_pembayaran');
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
