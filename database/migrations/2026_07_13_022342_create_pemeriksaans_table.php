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
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->char('nomor_pemeriksaan', 30);
            $table->foreignId('jadwal_id')->constrained('jadwals')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('anak_id')->constrained('anaks')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null')->onUpdate('cascade');
            $table->string('nomor_antri', 10);
            $table->enum('metode_kunjungan', ['hari_h', 'sweeping'])->default('hari_h');
            $table->date('tanggal_kunjungan');
            $table->integer('umur_bulan');
            $table->enum('approvel_status', ['darft', 'pending', 'approved', 'rejected']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaans');
    }
};
