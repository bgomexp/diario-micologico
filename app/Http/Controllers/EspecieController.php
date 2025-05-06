<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Especie;

class EspecieController extends Controller
{
    public function index(){
        //Paginamos los datos
        $especies = Especie::paginate(10);
        //Llamamos a la vista con los datos
        return view('especies.index', ['especies'=>$especies]);
    }
}
