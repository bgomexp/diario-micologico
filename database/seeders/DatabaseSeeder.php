<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Especie;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Belén',
            'email' => 'belengomtrad@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'admin',
        ]);

        Especie::factory()->create([
            "genero" => "Amanita",
            "especie" => "A. caesarea",
            "nombre_comun" => "Oronja",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "excelente comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Amanita",
            "especie" => "A. pantherina",
            "nombre_comun" => "Amanita pantera",
            "toxicidad" => "tóxica",
            "comestibilidad" => "no comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Ganoderma",
            "especie" => "G. lucidum",
            "nombre_comun" => "Pipa",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "no comestible",
        ]);
    }
}
