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
        Schema::create('detail_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peminjaman_id');
            $table->foreign('peminjaman_id')->references('id')->on('peminjaman')->onDelete('cascade');
            $table->unsignedBigInteger('barang_id');
            $table->foreign('barang_id')->references('id')->on('barang')->onDelete('cascade');
            $table->unsignedBigInteger('jumlah');
            $table->date('tanggal_ambil')->nullable();
            $table->string('bukti_ambil')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_peminjaman');
    }
};
