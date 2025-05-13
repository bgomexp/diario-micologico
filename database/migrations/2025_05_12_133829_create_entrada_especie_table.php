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
        Schema::create('entrada_especie', function (Blueprint $table) {
            $table->timestamps();

            $table->foreignId('id_entrada')
                ->constrained(
                    table: 'entradas'
                    )
                ->onDelete('cascade'); //Si se borra una entrada, se borran los ejemplares encontrados en esa entrada también
            
            $table->foreignId('id_especie')
                ->constrained(
                    table: 'especies'
                    )
                ->onDelete('cascade'); //Si se borra una especie, se borran los ejemplares encontrados de esa especie también

            //Primary key compuesta
            $table->primary(['id_entrada', 'id_especie']);
            
            $table->integer('cantidad')->unsigned()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrada_especie');
    }
};
