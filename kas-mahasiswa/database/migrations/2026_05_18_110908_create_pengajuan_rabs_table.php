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
        Schema::create('pengajuan_rabs', function (Blueprint $table) {
            $table->id();

            // Relasi ke user yang mengajukan RAB
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Relasi ke departemen
            $table->foreignId('departemen_id')
                  ->constrained('departemens')
                  ->cascadeOnDelete();

            $table->string('nama_kegiatan');
            $table->date('tanggal_kegiatan');
            $table->text('tujuan_kegiatan');
            $table->text('rincian_kebutuhan');
            $table->decimal('total_dana', 15, 2);

            $table->string('status')->default('Menunggu Verifikasi Bendahara');

            $table->text('catatan_bendahara')->nullable();
            $table->text('catatan_ketua')->nullable();

            $table->timestamp('tanggal_verifikasi_bendahara')->nullable();
            $table->timestamp('tanggal_persetujuan_ketua')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_rabs');
    }
};