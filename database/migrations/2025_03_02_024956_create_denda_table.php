<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDendaTable extends Migration
{
    public function up()
    {
        Schema::create('denda', function (Blueprint $table) {
            $table->increments('id_denda'); // Primary key
            $table->unsignedInteger('id_peminjaman'); // Foreign key
            $table->unsignedInteger('id_barang')->nullable(); // Foreign key, nullable jika tidak selalu ada
            $table->string('nisn', 20)->nullable(); // Foreign key, nullable jika tidak selalu ada
            $table->integer('jumlah_denda'); // Jumlah denda
            $table->string('keterangan')->nullable(); // Keterangan, nullable jika tidak selalu ada
            $table->enum('status', ['belum dibayar', 'sudah dibayar'])->default('belum dibayar'); // Status denda
            $table->timestamps(); // Timestamps untuk created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('denda');
    }
}