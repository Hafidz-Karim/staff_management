<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;

    protected $table = 'izin';

    protected $fillable = [
        'user_id',
        'jenis_izin',
        'tanggal_mulai',
        'tanggal_selesai',
        'alasan',
        'bukti',
        'status',
        'catatan_admin',
    ];

    // Relasi ke User (pegawai)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
