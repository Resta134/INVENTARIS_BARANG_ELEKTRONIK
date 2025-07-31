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
        Schema::create('barang_elektronik', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang')->unique();
            $table->string('kode_barang')->unique();
            $table->string('kategori');
            $table->string('merk')->nullable();
            $table->string('model')->nullable();
            $table->integer('tahun_pembelian');
            $table->string('kondisi');
            $table->integer('jumlah');
            $table->string('lokasi_penyimpanan');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_elektronik');
    }
};
