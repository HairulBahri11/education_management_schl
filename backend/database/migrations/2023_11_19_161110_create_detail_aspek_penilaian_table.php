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
        Schema::create('detail_aspek_penilaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aspek_penilaian_id')->constrained('aspek_penilaian')->onDelete('cascade');
            $table->string('nama_detail_aspek_penilaian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_aspek_penilaian');
    }
};
