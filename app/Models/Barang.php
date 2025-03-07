<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    public $timestamps = false; // Pastikan timestamps diaktifkan

    protected $fillable = [
        'nama_barang',
        'stok', 
        'kategori',
        'kondisi', 
    ];

    public function kurangiStok($jumlah)
    {
        $this->stok -= $jumlah;
        $this->save();
    }

    public function tambahStok($jumlah)
    {
        $this->stok += $jumlah;
        $this->save();
    }

    public function bisaDipinjam($jumlah)
    {
        return $this->stok >= $jumlah && $this->status === 'tidak cacat';
    }
}