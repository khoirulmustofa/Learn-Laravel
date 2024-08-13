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
        Schema::create('kbm_presensi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kbm_jadwal_id');
            $table->unsignedBigInteger('student_id');
            $table->string('presence',50);
            $table->text('informastion')->nullable();
            $table->timestamps();

            $table->foreign('kbm_jadwal_id')->references('id')->on('kbm_jadwal')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kbm_presensi');
    }
};
