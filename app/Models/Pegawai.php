<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawais'; // <- tambahkan ini

    protected $fillable = [
        'nama',
        'jabatan',
        'email',
        'no_telepon',
        'status'
        // tambahkan kolom lain sesuai migrasi kamu
    ];
     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
