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
        Schema::create('pemeriksaan_antropometris', function (Blueprint $table) {
            $table->foreignId('pemeriksaan_id')->primary()->constrained('pemeriksaans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->float('berat_badan');
            $table->float('tinggi_badan');
            $table->float('lingkar_kepala')->nullable();
            $table->enum('tren_pertumbuhan', ['N', 'T', 'BGM', '-'])->default('-');
            $table->enum('status_gizi', ['normal', 'gizi_kurang', 'gizi_buruk', 'gizi_lebih'])->default('normal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_antropometris');
    }
};
