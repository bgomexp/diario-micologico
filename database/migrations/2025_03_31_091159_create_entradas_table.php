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
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('id_usuario')
                ->constrained(
                    table: 'users'
                    )
                ->onDelete('cascade'); //Si se borra un usuario, se borran sus entradas también
            $table->date("fecha");
            $table->string("lugar")->nullable();
            $table->string("comentarios")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
