<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit($id) {
        //Si la cuenta es del usuario autenticado, le mostramos los datos
        if ($id == auth()->id()) {
            $user = User::findOrFail($id);
            return view('users.edit', ['user'=>$user]);
        }
        //Si la cuenta no es del usuario, mostramos un mensaje de error y redirigimos
        else{
            session()->flash('message', 'Error de permisos. No tienes permiso para acceder a esta operación.');
            return redirect()->route('contenido');
        }
    }

    public function update_data(Request $request) {
        //Obtenemos el usuario
        $user = auth()->user();
        //Validaciones
        $request->validate([
            'name' => 'required|string',
            'surname' => 'nullable|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        //Le asignamos las propiedades
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        //Guardamos el usuario en la base de datos
        $user->save();
        //Volvemos a donde estábamos
        session()->flash('message', 'Datos de usuario modificados correctamente.');
        return view('users.edit', ['user'=>$user]);
    }

    public function update_password(Request $request) {
        //Obtenemos el usuario
        $user = auth()->user();
        //Validación
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|confirmed',
        ]);
        //Si la contraseña introducida es correcta, hacemos el procedimiento de cambiar la contraseña
        if (Hash::check($request->old_password, $user->password)) {
            //Asignamos la nueva contraseña
            $user->password = Hash::make($request->password);
            //Guardamos
            $user->save();
            //Volvemos a donde estábamos
            return back()->with('message', 'Contraseña actualizada correctamente.');
        }
        else{
            return back()->withErrors(['old_password' => 'La contraseña actual introducida no es correcta.']);
        }
        
    }
    
    public function destroy(Request $request) {
        //Tomamos el usuario
        $user = auth()->user();
        // Cerramos la sesión
        auth()->logout();
        // Borramos la cuenta
        $user->delete();
        // Redirigimos a la página de login
        return redirect('/login')->with('message', 'Tu cuenta ha sido eliminada.');
    }
}
