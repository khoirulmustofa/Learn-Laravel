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
        Schema::create('kbm_jadwal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->integer('session');
            $table->unsignedBigInteger('kbm_mapel_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('kbm_mapel_id')->references('id')->on('kbm_mapel')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kbm_jadwal');
    }
};
