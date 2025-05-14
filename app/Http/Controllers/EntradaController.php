<?php

namespace App\Http\Controllers;
use App\Models\Entrada;
use App\Models\Especie;

use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function index(){
        //Obtenemos las entradas de ese usuario y las paginamos
        $entradas = Entrada::where('id_usuario', auth()->id())->paginate(5);
        //Llamamos a la vista con los datos
        return view('entradas.index', ['entradas'=>$entradas]);

    }

    public function create(){
        $especies = Especie::all();
        //Llamamos a la vista con los datos
        return view('entradas.create', ['especies'=>$especies]);
    }

    public function store(Request $request){
        //Validamos los datos
        $request->validate([
            //TODO
        ]);
        //Creamos la entrada y le asignamos los datos
        $entrada = new Entrada();
        $entrada->id_usuario = auth()->id();
        $entrada->fecha = $request->fecha;
        $entrada->lugar = $request->lugar;
        $entrada->comentarios = $request->comentarios;
        $entrada->save();
        //Guardamos las especies en la tabla pivot
        $idAsignado = $entrada->id;

        foreach ($request->setas as $seta) {
            $entrada->especies()->attach($seta["especie"], ['cantidad' => $seta["cantidad"]]);
        }

        session()->flash('message', 'Entrada almacenada correctamente');
        //Volvemos al listado de tareas
        return redirect()->route('entradas.index');
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
