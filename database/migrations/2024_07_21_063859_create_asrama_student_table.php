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
        Schema::create('asrama_student', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('asrama_id');
            $table->unsignedBigInteger('student_id');
            $table->string('academic_year');
            $table->string('semester');
            $table->string('status');
            $table->timestamps();
            
            $table->foreign('asrama_id')->references('id')->on('asrama')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asrama_student');
    }
};
