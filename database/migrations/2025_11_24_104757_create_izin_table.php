<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('izin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('jenis_izin'); // sakit, pribadi, dinas, dll
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable(); // boleh 1 hari
            $table->text('alasan')->nullable();
            $table->string('bukti')->nullable(); // foto bukti opsional
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->string('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('izin');
    }
};
