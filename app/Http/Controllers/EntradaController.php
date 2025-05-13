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

    public function store(Request $request){
       dd($request);
        /*
        //Validamos los datos
        $request->validate([
            //TODO
        ]);
        $entrada = new Entrada();
        //$entrada->id_usuario = ????;
        $entrada->fecha = $request->fecha;
        $entrada->lugar = $request->lugar;
        $entrada->comentarios = $request->comentarios;
        $entrada->save();

        //TODO guardar las especies

        session()->flash('message', 'Entrada almacenada correctamente');
        //Volvemos al listado de tareas
        return redirect()->route('entradas.index'); */
    }

    /*public function edit($id){
        //TODO
    }*/

    public function update(Request $request){
        
        //TODO

        session()->flash('message', 'Entrada modificada correctamente');
        //Volvemos al listado de tareas
        return redirect()->route('entradas.index');
    }

    public function destroy($id) {
        $entrada = Entrada::findOrFail($id); //FIXME SOLO LAS DEL USUARIO LOGUEADO
        $entrada->delete();
        session()->flash('message', 'La entrada ha sido eliminada correctamente.');
        //Volvemos al listado de entradas
        return redirect()->route('entradas.index');
    }
}
