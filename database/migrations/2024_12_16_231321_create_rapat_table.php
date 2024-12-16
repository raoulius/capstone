<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRapatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rapat', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('nama'); // Nama field
            $table->string('email'); // Email field
            $table->date('tanggal'); // Tanggal field
            $table->time('waktu_mulai'); // Waktu mulai field
            $table->time('waktu_selesai'); // Waktu selesai field
            $table->string('jenis_rapat'); // Jenis rapat field
            $table->text('agenda'); // Agenda field
            $table->timestamps(); // Created_at and updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rapat');
    }
}
