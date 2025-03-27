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

        Schema::create('replies', function (Blueprint $table) {
            $table->integer('id_user')->primary();
            $table->foreign('id_user')->references('id')->on('users');
            $table->integer('id_question')->primary();
            $table->foreign('id_question')->references('id')->on('questions');
            $table->integer('score');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
