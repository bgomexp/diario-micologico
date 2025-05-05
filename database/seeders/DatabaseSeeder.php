<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Especie;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        Especie::factory()->create([
            "genero" => "Amanita",
            "especie" => "A. caesarea",
            "nombre_comun" => "Oronja",
            "toxicidad" => "no tóxico",
            "comestibilidad" => "excelente comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Amanita",
            "especie" => "A. pantherina",
            "nombre_comun" => "Amanita pantera",
            "toxicidad" => "tóxico",
            "comestibilidad" => "no comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Ganoderma",
            "especie" => "G. lucidum",
            "nombre_comun" => "Pipa",
            "toxicidad" => "no tóxico",
            "comestibilidad" => "no comestible",
        ]);
    }
}
