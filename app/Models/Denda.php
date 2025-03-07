<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    use HasFactory;

    protected $table = 'denda';  
    protected $primaryKey = 'id_denda';

    // Menonaktifkan timestamps
    public $timestamps = false;

    protected $fillable = [
        'id_peminjaman',
        'id_barang',
        'nisn',
        'jumlah_denda',
        'keterangan',
        'status',
    ];

    // Relasi dengan model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    // Relasi dengan model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn');
    }

    // Relasi dengan model Peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
    }
}