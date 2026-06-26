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
        Schema::create('vinculo_loja', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_empregado');
            $table->foreign('id_empregado')->references('id')->on('users');
            $table->unsignedInteger('id_loja');
            $table->foreign('id_loja')->references('id')->on('loja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vinculo_loja');
    }
};
