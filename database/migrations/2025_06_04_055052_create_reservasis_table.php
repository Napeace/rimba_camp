<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal_checkin');
            $table->timestamp('tanggal_checkout');
            $table->enum('status_reservasi', ['menunggu_konfirmasi', 'disetujui', 'ditolak'])->default('menunggu_konfirmasi');
            $table->string('bukti_pembayaran', 255);
            $table->timestamps();

            // Foreign keys
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('cottage_id')->constrained('cottages')->onDelete('cascade');

            // Indexes
            $table->index(['status_reservasi', 'created_at']);
            $table->index('tanggal_checkin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
