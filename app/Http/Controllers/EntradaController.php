<?php

namespace App\Http\Controllers;
use App\Models\Entrada;

use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function index(){
        //Paginamos los datos
        $entradas = Entrada::paginate(5);
        //Llamamos a la vista con los datos
        return view('entradas.index', ['entradas'=>$entradas]);
    }
}
