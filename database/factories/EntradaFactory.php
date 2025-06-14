<?php

namespace Database\Factories;

use App\Models\Entrada;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EntradaFactory extends Factory
{
    protected $model = Entrada::class;

    public function definition()
    {
        return [
            'id_usuario' => \App\Models\User::factory(),
            'titulo' => $this->faker->sentence,
            'fecha' => now(),
            'lugar' => '45.5|-3.5',
            'comentarios' => $this->faker->paragraph,
        ];
    }
}