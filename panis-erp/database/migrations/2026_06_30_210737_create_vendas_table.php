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
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_loja');
            $table->foreign('id_loja')->references('id')->on('loja');
            // $table->unsignedInteger('id_tipo_lancamento');
            // $table->foreign('id_tipo_lancamento')->references('id')->on('tipo_venda');
            $table->date('data_referencia');
            $table->double('valor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
