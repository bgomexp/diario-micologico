<?php

namespace Database\Factories;

use App\Models\Especie;
use Illuminate\Database\Eloquent\Factories\Factory;

class EspecieFactory extends Factory
{
    protected $model = Especie::class;

    public function definition(): array
    {
        return [
        'genero' => $this->faker->randomElement(['Boletus', 'Amanita', 'Russula']),
        'especie' => $this->faker->bothify('B. ???'),
        'nombre_comun' => $this->faker->word(),
        'toxicidad' => $this->faker->randomElement(['tóxica', 'no tóxica', 'mortal']),
        'comestibilidad' => $this->faker->randomElement([
                'excelente comestible',
                'excelente comestible con precaución', 
                'comestible',
                'comestible con precaución',
                'sin valor culinario', 
                'no comestible'
            ]),
        ];
    }
}