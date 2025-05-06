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
        Schema::table('user_faces', function (Blueprint $table) {
            $table->unsignedBigInteger('member_id')->index();

            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_faces', function (Blueprint $table) {
            $table->dropForeign(['member_id']); 
            $table->dropColumn('member_id');
        });
    }
};
