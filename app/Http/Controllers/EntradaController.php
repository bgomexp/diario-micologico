<?php

namespace App\Http\Controllers;
use App\Models\Entrada;
use App\Models\Especie;

use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function index(){
        //Paginamos los datos
        $entradas = Entrada::paginate(5);
        //Llamamos a la vista con los datos
        return view('entradas.index', ['entradas'=>$entradas]);

        //FIXME SOLO LAS DEL USUARIO LOGUEADO
    }

    public function create(){
        $especies = Especie::all();
        //Llamamos a la vista con los datos
        return view('entradas.create', ['especies'=>$especies]);
    }
}
