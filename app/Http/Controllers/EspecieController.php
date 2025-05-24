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

    /*public function update(Request $request, $id){
        //Validamos los datos igual que en store
        $request->validate([
            'fecha' => 'required|date|date_format:d-m-Y|before_or_equal:today',
            'lugar' => 'nullable',
            'comentarios' => 'nullable',
            'setas' => 'nullable|array',
            'setas.*.especie' => 'required|integer|min:0',
            'setas.*.cantidad' => 'required|integer|min:1',
        ]);
        //Recuperamos la entrada y asignamos los datos
        $entrada = Entrada::with('especies')->findOrFail($id);
        $entrada->fecha = $request->fecha;
        $entrada->lugar = $request->lugar;
        $entrada->comentarios = $request->comentarios;
        $entrada->save();
        //Procesamos las especies
        $datosPivot = [];
        foreach ($request->setas as $seta) {
            $datosPivot[$seta['especie']] = ['cantidad' => $seta['cantidad']];
        }
        // Actualizamos la tabla pivot
        $entrada->especies()->sync($datosPivot);

        session()->flash('message', 'Entrada modificada correctamente');
        //Volvemos al listado de tareas
        return redirect()->route('entradas.show', $entrada->id);
    }*/

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
