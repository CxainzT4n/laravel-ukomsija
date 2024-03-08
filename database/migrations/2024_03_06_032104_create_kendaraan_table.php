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
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kendaraan');
            $table->string('spesifikasi');
            $table->string('lokasi');
            $table->string('kondisi');
            $table->integer('total_unit')->computed('jumlah_masuk - jumlah-pinjam - jumlah_keluar')->default(0);
            $table->integer('jumlah_masuk')->default(0);
            $table->integer('jumlah_keluar')->default(0);
            $table->string('sumber_dana');
            $table->string('peminjam')->nullable();
            $table->string('penerima')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('jumlah_pinjam')->default(0);
            $table->dateTime('tanggal_kembali')->nullable();
            $table->dateTime('tanggal_keluar')->nullable()->default(now());
            $table->timestamps();
        });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
