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
        Schema::create('detail_raport', function (Blueprint $table) {
            $table->id();
            $table->foreignId('raport_id')->constrained('raport');
            $table->foreignId('aspek_id')->constrained('aspek_penilaian');
            $table->foreignId('detail_aspek_id')->constrained('detail_aspek_penilaian');
            $table->integer('nilai');
            $table->string('simbol_mutu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_raport');
    }
};
