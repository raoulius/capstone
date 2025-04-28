<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rapat_id');
            $table->string('nama');
            $table->string('email');
            $table->timestamp('waktu_absen');
            $table->string('komisi_type');
            $table->timestamps();

            $table->foreign('rapat_id')->references('id')->on('master_rapat')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendance_records');
    }
}; 