<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanHarian extends Model
{
    //


    protected $fillable = [
        'guru_id',
        'tanggal',
        'kelas',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'materi',
        'catatan',
    ];
}
