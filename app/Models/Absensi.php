<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

 protected $fillable = [
    'siswa_id',
    'guru_id',
    'jadwal_id',
    'tanggal',
    'status',
];


    // kalau ada relasi
    public function siswa()
    {
        return $this->belongsTo(\App\Models\Siswa::class, 'siswa_id');
    }
}
