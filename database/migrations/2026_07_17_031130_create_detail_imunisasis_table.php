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
        Schema::create('detail_imunisasis', function (Blueprint $table) {
            $table->foreignId('pemeriksaan_medis_id')
                ->constrained('pemeriksaan_medis', 'pemeriksaan_id')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('imunisasi_id')
                ->constrained('imunisasis')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->primary(['pemeriksaan_medis_id', 'imunisasi_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_imunisasis');
    }
};
