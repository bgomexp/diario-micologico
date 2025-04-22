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
        Schema::create('especies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string("genero");
            $table->string("especie");
            $table->string("nombre_comun")->nullable();
            $table->enum("toxicidad", ["tóxico", "mortal"])->nullable();
            $table->enum("comestibilidad", ["excelente comestible", "excelente comestible con precaución", "comestible", "comestible con precaución", "sin valor culinario", "no comestible"])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especies');
    }
};
