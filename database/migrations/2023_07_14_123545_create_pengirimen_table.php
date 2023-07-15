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
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->id();
            $table->string('no_pengiriman', 10);
            $table->date('tanggal');
            $table->integer('lokasi_id')->nullable();
            $table->integer('barang_id')->nullable();
            $table->integer('jumlah_barang')->nullable();
            $table->integer('harga_barang')->nullable();
            $table->integer('kurir_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman');
    }
};
