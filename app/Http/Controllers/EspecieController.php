<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Especie;

class EspecieController extends Controller
{
    public function index(){
        //Paginamos los datos
        $especies = Especie::orderBy('genero', 'asc')->orderBy('especie', 'asc')->paginate(10);
        //Llamamos a la vista con los datos
        return view('especies.index', ['especies'=>$especies]);
    }

    public function create(){
        //Comprobamos si el usuario es admin
        if (auth()->user()->role=="admin") {
            return view('especies.create');
        }
        else{
            session()->flash('message', 'Error de permisos. No tienes permiso para acceder a esta operación.');
            return redirect()->route('especies.index');
        }
    }

    public function store(Request $request){
        if (auth()->user()->role=="admin") {
            //Validamos los datos
            $request->validate([
                'genero' => 'required',
                'especie' => 'required|regex:/^[A-ZÑÁÉÍÓÚ]\. [a-zñáéíóúü]+$/',
                'nombre_comun' => 'nullable',
                'toxicidad' => 'nullable|in:no tóxica,tóxica,mortal',
                'comestibilidad' => 'nullable|in:excelente comestible,excelente comestible con precaución,comestible,comestible con precaución,sin valor culinario,no comestible',
            ]);
            //Creamos la especie y le asignamos los datos
            $especie = new Especie();
            $especie->genero = strtoupper($request->genero[0]).strtolower(substr($request->genero, 1));
            $especie->especie = $request->especie;
            $especie->nombre_comun = $request->nombre_comun;
            $especie->toxicidad = $request->toxicidad;
            $especie->comestibilidad = $request->comestibilidad;
            $especie->save();
            //Redirigimos al index
            return redirect()->route('especies.index');
        }
        else{
            session()->flash('message', 'Error de permisos. No tienes permiso para acceder a esta operación.');
            return redirect()->route('especies.index');
        }
    }

    public function show($id) {
        $especie = Especie::findOrFail($id);
        return view('especies.show', ['especie'=>$especie]);
    }

    public function edit($id){
        //Comprobamos si el usuario es admin
        if (auth()->user()->role=="admin") {
            $especie = Especie::findOrFail($id);
            return view('especies.edit', ['especie'=>$especie]);
        }
        else{
            session()->flash('message', 'Error de permisos. No tienes permiso para acceder a esta operación.');
            return redirect()->route('especies.index');
        }
    }

    public function update(Request $request, $id){
        if (auth()->user()->role=="admin") {
            //Validamos los datos igual que en store
            $request->validate([
                'genero' => 'required',
                'especie' => 'required|regex:/^[A-ZÑÁÉÍÓÚ]\. [a-zñáéíóúü]+$/',
                'nombre_comun' => 'nullable',
                'toxicidad' => 'nullable|in:no tóxica,tóxica,mortal',
                'comestibilidad' => 'nullable|in:excelente comestible,excelente comestible con precaución,comestible,comestible con precaución,sin valor culinario,no comestible',
            ]);
            //Recuperamos la entrada y asignamos los datos
            $especie = Especie::findOrFail($id);
            $especie->genero = strtoupper($request->genero[0]).strtolower(substr($request->genero, 1));
            $especie->especie = $request->especie;
            $especie->nombre_comun = $request->nombre_comun;
            $especie->toxicidad = $request->toxicidad;
            $especie->comestibilidad = $request->comestibilidad;
            $especie->save();
            //Notificamos la operación
            session()->flash('message', 'Entrada modificada correctamente');
        }
        else{
            session()->flash('message', 'Error de permisos. No tienes permiso para acceder a esta operación.');
        }
        //Volvemos a la tarea
            return redirect()->route('especies.show', $especie->id);
    }

    public function destroy($id) {
        //Comprobamos si el usuario es admin
        if (auth()->user()->role=="admin") {
            $especie = Especie::findOrFail($id);
            $especie->delete();
            session()->flash('message', 'La especie ha sido eliminada correctamente.');
        }
        else{
            session()->flash('message', 'Error de permisos. No tienes permiso para acceder a esta operación.');
        }
        //Volvemos al listado de especies
        return redirect()->route('especies.index');
    }
}
