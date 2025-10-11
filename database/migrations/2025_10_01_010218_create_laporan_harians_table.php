<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_harians', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('guru_id');
        $table->date('tanggal');
        $table->string('kelas');
        $table->string('hari');
        $table->time('jam_mulai');
        $table->time('jam_selesai');
        $table->text('materi');
        $table->text('catatan')->nullable();
        $table->timestamps();

        $table->foreign('guru_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_harians');
    }
};
