<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';
    
    // Menonaktifkan timestamps
    public $timestamps = false;

    protected $fillable = [
        'id_barang',
        'nisn',
        'jumlah_pinjam',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_dikembalikan',
        'status',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn');
    }

    // Tambahkan relasi denda
    public function denda()
    {
        return $this->hasMany(Denda::class, 'id_peminjaman');
    }
}