<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiPegawai extends Model
{
    use HasFactory;

    protected $table = 'absensi_pegawais'; // opsional, kalau nama beda

    protected $fillable = [
        'user_id',
        'tanggal',
        'hari',
        'waktu_masuk',
        'waktu_pulang',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
