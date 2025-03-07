<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id('id_barang'); // Kolom ID untuk barang
            $table->string('nama_barang'); // Kolom untuk nama barang
            $table->string('kategori'); // Kolom untuk kategori barang
            $table->integer('stok'); // Kolom untuk stok barang
            $table->enum('status', ['cacat', 'tidak cacat']);  // Kolom untuk kondsi barang 
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang'); // Menghapus tabel barang jika migrasi dibatalkan
    }
};