<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_kerjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('users')->onDelete('cascade');
            $table->string('hari'); // contoh: Senin, Selasa, dst.
            $table->date('tanggal'); // tanggal kerja
            $table->time('jam_mulai'); // misal "08:00"
            $table->time('jam_selesai'); // misal "16:00"
            $table->text('kegiatan')->nullable(); // deskripsi pekerjaan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_kerjas');
    }
};
