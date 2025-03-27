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
        Schema::disableForeignKeyConstraints();

        Schema::create('abouts', function (Blueprint $table) {
            $table->integer('id_lesson')->primary();
            $table->foreign('id_lesson')->references('id')->on('lessons');
            $table->integer('id_quizz')->primary();
            $table->foreign('id_quizz')->references('id')->on('quizz');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
