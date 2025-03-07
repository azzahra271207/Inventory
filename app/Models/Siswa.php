<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = ['nisn', 'nama_siswa', 'kelas', 'jurusan'];

    public $timestamps = false; // Menonaktifkan timestamps

    protected $primaryKey = 'nisn'; // Menetapkan nisn sebagai primary key

    public $incrementing = false; // Menonaktifkan auto-increment
}