<?php

namespace App\Http\Controllers;
use App\Models\Entrada;
use App\Models\Especie;

use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function index(){
        //Obtenemos las entradas de ese usuario y las paginamos
        $entradas = Entrada::with('especies')
                    ->where('id_usuario', auth()->id())
                    ->paginate(10);
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
            'fecha' => 'required|date|date_format:d-m-Y|before_or_equal:today', //La fecha es obligatoria y debe ser la de hoy o una anterior
            'lugar' => 'nullable',
            'comentarios' => 'nullable',
            'setas' => 'nullable|array',
            'setas.*.especie' => 'required|integer|min:0',
            'setas.*.cantidad' => 'required|integer|min:1',
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

    public function show($id) {
        $entrada = Entrada::with('especies')->findOrFail($id);
        //Si la entrada es del usuario autenticado, le mostramos los datos
        if ($entrada->id_usuario == auth()->id()) {
            return view('entradas.show', ['entrada'=>$entrada]);
        }
        //Si la entrada no es del usuario, mostramos un mensaje de error y redirigimos al index
        else{
            session()->flash('message', 'Error al mostrar la entrada.');
            return redirect()->route('entradas.index');
        }
    }

    public function edit($id){
        $entrada = Entrada::with('especies')->findOrFail($id);
        $especies = Especie::all();
        //Si la entrada es del usuario autenticado, le mostramos el formulario de edición
        if ($entrada->id_usuario == auth()->id()) {
            return view('entradas.edit', ['entrada'=>$entrada, 'especies'=>$especies]);
        }
        //Si la entrada no es del usuario, mostramos un mensaje de error y redirigimos al index
        else{
            session()->flash('message', 'Error al editar la entrada.');
            return redirect()->route('entradas.index');
        }
    }

    public function update(Request $request, $id){
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
    }

    public function destroy($id) {
        $entrada = Entrada::findOrFail($id);
        //Permitimos la eliminación solo si la entrada pertenece al usuario autenticado
        if ($entrada->id_usuario == auth()->id()) {
            $entrada->delete();
            session()->flash('message', 'La entrada ha sido eliminada correctamente.');
        }
        else{
            session()->flash('message', 'Error al eliminar la entrada.');
        }
        //Volvemos al listado de entradas
        return redirect()->route('entradas.index');
    }
}
