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
            'titulo' => 'nullable|string|max:255',
            'fecha' => 'required|date|date_format:d-m-Y|before_or_equal:today', //La fecha es obligatoria y debe ser la de hoy o una anterior
            'lat' => 'nullable|numeric|min:-90|max:90',
            'lng' => 'nullable|numeric|min:-180|max:180',
            'comentarios' => 'nullable|string|max:10000',
            'setas' => 'nullable|array|max:100',
            'setas.*.especie' => 'required|integer|min:0|max:5000',
            'setas.*.cantidad' => 'required|integer|min:1|max:5000',
        ]);
        //Creamos la entrada y le asignamos los datos
        $entrada = new Entrada();
        $entrada->id_usuario = auth()->id();
        $entrada->titulo = $request->titulo;
        $entrada->fecha = $request->fecha;
        if (isset($request->lat) && isset($request->lng)) {
            $entrada->lugar = $request->lat."|".$request->lng;
        }
        $entrada->comentarios = $request->comentarios;
        $entrada->save();
        //Guardamos las especies en la tabla pivot
        
        if ($request->setas!=null) {
            foreach ($request->setas as $seta) {
                $entrada->especies()->attach($seta["especie"], ['cantidad' => $seta["cantidad"]]);
            }
        }

        session()->flash('success', 'La entrada ha sido almacenada correctamente.');
        //Volvemos al listado de tareas
        return redirect()->route('entradas.index');
    }

    public function show($id) {
        //Si la entrada es del usuario autenticado, le mostramos los datos
        $entrada = Entrada::with('especies')->findOrFail($id);
        if ($entrada->id_usuario == auth()->id()) {
            return view('entradas.show', ['entrada'=>$entrada]);
        }
        //Si la entrada no es del usuario, mostramos un mensaje de error y redirigimos al index
        else{
            session()->flash('fail', 'Error de permisos. No tienes permiso para acceder a esta operación.');
            return redirect()->route('entradas.index');
        }
    }

    public function edit($id){
        //Si la entrada es del usuario autenticado, le mostramos el formulario de edición
        $entrada = Entrada::with('especies')->findOrFail($id);
        if ($entrada->id_usuario == auth()->id()) {
            $especies = Especie::all();
            return view('entradas.edit', ['entrada'=>$entrada, 'especies'=>$especies]);
        }
        //Si la entrada no es del usuario, mostramos un mensaje de error y redirigimos al index
        else{
            session()->flash('fail', 'Error de permisos. No tienes permiso para acceder a esta operación.');
            return redirect()->route('entradas.index');
        }
    }

    public function update(Request $request, $id){
        $entrada = Entrada::findOrFail($id);
        if ($entrada->id_usuario == auth()->id()){
            //Validamos los datos igual que en store
            $request->validate([
                'titulo' => 'nullable|string|max:255',
                'fecha' => 'required|date|date_format:d-m-Y|before_or_equal:today',
                'lat' => 'nullable|numeric|min:-90|max:90',
                'lng' => 'nullable|numeric|min:-180|max:180',
                'comentarios' => 'nullable|string|max:10000',
                'setas' => 'nullable|array|max:100',
                'setas.*.especie' => 'required|integer|min:0|max:5000',
                'setas.*.cantidad' => 'required|integer|min:1|max:5000',
            ]);
            //Recuperamos la entrada y asignamos los datos
            $entrada = Entrada::with('especies')->findOrFail($id);
            $entrada->titulo = $request->titulo;
            $entrada->fecha = $request->fecha;
            if (isset($request->lat) && isset($request->lng)) {
                $entrada->lugar = $request->lat."|".$request->lng;
            }else{
                $entrada->lugar = null;
            }
            $entrada->comentarios = $request->comentarios;
            $entrada->save();
            //Procesamos las especies
            $datosPivot = [];
            if ($request->setas!=null){
                foreach ($request->setas as $seta) {
                    $datosPivot[$seta['especie']] = ['cantidad' => $seta['cantidad']];
                }
            }
            // Actualizamos la tabla pivot
            $entrada->especies()->sync($datosPivot);

            session()->flash('success', 'La entrada ha sido modificada correctamente.');
        }
        else{
            session()->flash('fail', 'Error de permisos. No tienes permiso para acceder a esta operación.');
        }
        //Volvemos al listado de tareas
        return redirect()->route('entradas.index');
    }

    public function destroy($id) {
        //Permitimos la eliminación solo si la entrada pertenece al usuario autenticado
        $entrada = Entrada::findOrFail($id);
        if ($entrada->id_usuario == auth()->id()) {
            $entrada->delete();
            session()->flash('success', 'La entrada ha sido eliminada correctamente.');
        }
        else{
            session()->flash('fail', 'Error de permisos. No tienes permiso para acceder a esta operación.');
        }
        //Volvemos al listado de entradas
        return redirect()->route('entradas.index');
    }
}
