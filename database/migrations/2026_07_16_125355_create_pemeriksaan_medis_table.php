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
        Schema::create('pemeriksaan_medis', function (Blueprint $table) {
            $table->foreignId('pemeriksaan_id')->primary()->constrained('pemeriksaans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->enum('pemberian_vitamin',['tidak','vitamin_a_merah','vitamin_a_biru']);
            $table->boolean('pemberian_obat_cacing')->default(false);
            $table->boolean('status_rujukan_medis')->default(false);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_medis');
    }
};
