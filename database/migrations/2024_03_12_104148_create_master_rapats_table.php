<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('master_rapat', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->date('tanggal');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('jenis_rapat');
            $table->text('agenda');
            $table->string('komisi_type');  // To store which komisi/badan this is from
            $table->unsignedBigInteger('original_id'); // ID from the original table
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_rapat');
    }
};