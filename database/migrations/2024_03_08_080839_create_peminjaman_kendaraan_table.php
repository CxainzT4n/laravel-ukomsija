<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peminjam_id')->nullable();
            $table->foreign('peminjam_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('kendaraan_id')->nullable();
            $table->foreign('kendaraan_id')->references('id')->on('kendaraan')->onDelete('set null');
            $table->string('nama_kendaraan');
            $table->string('kondisi');
            $table->integer('jumlah_pinjam')->nullable();
            $table->dateTime('tanggal_kembali')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman_kendaraan');
    }
};

