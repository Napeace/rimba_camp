<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_checkin');
            $table->date('tanggal_checkout');
            $table->string('status_reservasi', 100);
            $table->string('bukti_pembayaran')->nullable();
            $table->string('users_email');
            $table->unsignedBigInteger('reservasis_id')->nullable();
            $table->unsignedBigInteger('cottages_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('users_email')->references('email')->on('users')->onDelete('cascade');
            $table->foreign('reservasis_id')->references('id')->on('reservasis')->onDelete('set null');
            $table->foreign('cottages_id')->references('id')->on('cottages')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservasis');
    }
};
