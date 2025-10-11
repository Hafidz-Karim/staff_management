<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKerja extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id', 'hari', 'tanggal', 'jam_mulai', 'jam_selesai', 'kegiatan'
    ];
    public function pegawai()
    {
         return $this->belongsTo(User::class, 'pegawai_id');
    }
}
