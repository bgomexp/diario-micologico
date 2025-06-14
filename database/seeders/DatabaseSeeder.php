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

        /**USUARIOS */
        User::factory()->create([
            'name' => 'Belén',
            'email' => 'b@b.es',
            'password' => Hash::make('1234'),
            'role' => 'admin',
        ]);

        /**ESPECIES */
        Especie::factory()->create([
            "genero" => "Boletus",
            "especie" => "B. aereus",
            "nombre_comun" => "Faisán de alcornoque",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "excelente comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Lanmaoa",
            "especie" => "L. fragrans",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Boletus",
            "especie" => "B. radicans",
            "nombre_comun" => "Boleto blancuzco",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "sin valor culinario",
        ]);

        Especie::factory()->create([
            "genero" => "Imperator",
            "especie" => "I. luteocupreus",
            "toxicidad" => "tóxica",
            "comestibilidad" => "no comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Rubroboletus",
            "especie" => "R. rhodoxanthus",
            "toxicidad" => "tóxica",
            "comestibilidad" => "no comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Boletus",
            "especie" => "B. impolitus",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Leccinellum",
            "especie" => "L. lepidum",
            "nombre_comun" => "Faisán de jara",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Leccinellum",
            "especie" => "L. corsicum",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "comestible",
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
            "especie" => "A. citrina",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "sin valor culinario",
        ]);

        Especie::factory()->create([
            "genero" => "Amanita",
            "especie" => "A. crocea",
            "nombre_comun" => "Amanita enfundada",
            "toxicidad" => "tóxica",
            "comestibilidad" => "comestible con precaución",
        ]);

        Especie::factory()->create([
            "genero" => "Amanita",
            "especie" => "A. muscaria",
            "nombre_comun" => "Matamoscas",
            "toxicidad" => "tóxica",
            "comestibilidad" => "no comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Amanita",
            "especie" => "A. pantherina",
            "nombre_comun" => "Amanita pantera",
            "toxicidad" => "tóxica",
            "comestibilidad" => "no comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Amanita",
            "especie" => "A. phalloides",
            "nombre_comun" => "Oronja verde",
            "toxicidad" => "mortal",
            "comestibilidad" => "no comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Amanita",
            "especie" => "A. vaginata",
            "nombre_comun" => "Cucumela",
            "toxicidad" => "tóxica",
            "comestibilidad" => "comestible con precaución",
        ]);

        Especie::factory()->create([
            "genero" => "Amanita",
            "especie" => "A. ponderosa",
            "nombre_comun" => "Gurumelo",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Lactarius",
            "especie" => "L. sanguifluus",
            "nombre_comun" => "Níscalo color sangre",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Lactarius",
            "especie" => "L. tesquorum",
            "nombre_comun" => "Lactarius de la jara",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "sin valor culinario", //FIXME
        ]);

        Especie::factory()->create([
            "genero" => "Lactarius",
            "especie" => "L. cistophilus",
            "nombre_comun" => "Níscalo de los jarales",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "sin valor culinario",
        ]);

        Especie::factory()->create([
            "genero" => "Lactarius",
            "especie" => "L. deliciosus",
            "nombre_comun" => "Níscalo",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Lactarius",
            "especie" => "L. chrysorrheus",
            "nombre_comun" => "Falso níscalo",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "sin valor culinario",
        ]);

        Especie::factory()->create([
            "genero" => "Agrocybe",
            "especie" => "A. aegerita",
            "nombre_comun" => "Seta de chopo",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Entoloma",
            "especie" => "E. lividum",
            "toxicidad" => "tóxica",
            "comestibilidad" => "no comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Russula",
            "especie" => "R. rubroalba",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Coprinus",
            "especie" => "C. picaceus",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "sin valor culinario",
        ]);

        Especie::factory()->create([
            "genero" => "Coprinus",
            "especie" => "C. comatus",
            "nombre_comun" => "Chipirón de monte",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Clitopilus",
            "especie" => "C. prunulus",
            "nombre_comun" => "Panadera",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "excelente comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Clitocybe",
            "especie" => "C. odora",
            "nombre_comun" => "Seta anisada",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "sin valor culinario",
        ]);

        Especie::factory()->create([
            "genero" => "Agaricus",
            "especie" => "A. xanthodermus",
            "nombre_comun" => "Champiñón amarilleante",
            "toxicidad" => "tóxica",
            "comestibilidad" => "no comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Agaricus",
            "especie" => "A. campestris",
            "nombre_comun" => "Champiñón silvestre",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Omphalotus",
            "especie" => "O. olearius",
            "nombre_comun" => "Seta de olivo",
            "toxicidad" => "tóxica",
            "comestibilidad" => "no comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Cantharellus",
            "especie" => "C. pallens",
            "nombre_comun" => "Rebozuelo",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Macrolepiota",
            "especie" => "M. procera",
            "nombre_comun" => "Gallipierna",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Pholiota",
            "especie" => "P. carbonaria",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "sin valor culinario",
        ]);

        Especie::factory()->create([
            "genero" => "Laccaria",
            "especie" => "L. laccata",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "sin valor culinario",
        ]);

        Especie::factory()->create([
            "genero" => "Armillaria",
            "especie" => "A. mellea",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "comestible con precaución",
        ]);

        Especie::factory()->create([
            "genero" => "Hygrocybe",
            "especie" => "H. konradii",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "sin valor culinario",
        ]);

        Especie::factory()->create([
            "genero" => "Infundibulicybe",
            "especie" => "I. geotropa",
            "nombre_comun" => "Platera",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Clitocybe",
            "especie" => "C. nuda",
            "toxicidad" => "tóxica",
            "comestibilidad" => "comestible con precaución",
        ]);

        Especie::factory()->create([
            "genero" => "Fomes",
            "especie" => "F. fomentarius",
            "nombre_comun" => "Yesquero",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "sin valor culinario",
        ]);

        Especie::factory()->create([
            "genero" => "Meripilus",
            "especie" => "M. giganteus",
            "nombre_comun" => "Poliporo gigante",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "sin valor culinario",
        ]);

        Especie::factory()->create([
            "genero" => "Ganoderma",
            "especie" => "G. lucidum",
            "nombre_comun" => "Pipa",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "sin valor culinario",
        ]);

        Especie::factory()->create([
            "genero" => "Auricularia",
            "especie" => "A. auricula-judae",
            "nombre_comun" => "Oreja de Judas",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Tremella",
            "especie" => "T. mesenterica",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "sin valor culinario",
        ]);

        Especie::factory()->create([
            "genero" => "Lycoperdon",
            "especie" => "L. perlatum",
            "nombre_comun" => "Pedo de lobo",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "comestible",
        ]);

        Especie::factory()->create([
            "genero" => "Trametes",
            "especie" => "T. versicolor",
            "nombre_comun" => "Traje de flamenca",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "sin valor culinario",
        ]);

        Especie::factory()->create([
            "genero" => "Ramaria",
            "especie" => "R. stricta",
            "toxicidad" => "no tóxica",
            "comestibilidad" => "sin valor culinario",
        ]);

        Especie::factory()->create([
            "genero" => "Morchella",
            "especie" => "M. esculenta",
            "nombre_comun" => "Colmenilla",
            "toxicidad" => "tóxica",
            "comestibilidad" => "excelente comestible con precaución",
        ]);

        Especie::factory()->create([
            "genero" => "Helvella",
            "especie" => "lacunosa",
            "nombre_comun" => "Oreja de gato negra",
            "toxicidad" => "tóxica",
            "comestibilidad" => "comestible con precaución",
        ]);
    }
}
