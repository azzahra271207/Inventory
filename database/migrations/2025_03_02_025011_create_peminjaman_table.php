<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('id_peminjaman'); // Primary key
            $table->foreignId('id_barang')->constrained('barang')->onDelete('cascade'); // Foreign key ke tabel barang
            $table->string('nisn', 20); // NISN siswa
            $table->integer('jumlah_pinjam'); // Jumlah pinjam
            $table->date('tanggal_pinjam'); // Tanggal pinjam
            $table->date('tanggal_kembali')->nullable(); // Tanggal kembali menjadi nullable
            $table->date('tanggal_dikembalikan')->nullable(); // Tanggal dikembalikan (nullable)
            $table->enum('status', ['dipinjam', 'dikembalikan','didenda']); // Status peminjaman

            // Menambahkan index untuk nisn
            $table->index('nisn');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman'); // Menghapus tabel peminjaman
    }
};