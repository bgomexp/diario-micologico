<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function registration(Request $request){
        //Validaciones
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        //Creamos el objeto de usuario
        $user = new User();
        //Le asignamos las propiedades
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); //contraseña cifrada
        //Guardamos el usuario en la base de datos
        $user->save();
        //Iniciamos sesión con el usuario que se acaba de crear
        Auth::login($user);
        //Redirigimos al contenido
        return redirect(route("contenido"));
    }

    public function login(Request $request){
        //Tomamos las credenciales validadas
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        //Vemos si se ha marcado la opción de recordar la sesión
        $remember = $request->has("remember");
        //Intentamos iniciar sesión
        if (Auth::attempt($credentials, $remember)) {
            //Regeneramos la sesión por si acaso
            $request->session()->regenerate();
            //Redirigimos a la página a la que el usuario quería acceder
            return redirect()->intended(route("contenido"));
        }else{
            return redirect(route("login"))->with('warning','Login fallido.');
        }

    }

    public function logout(Request $request){
        //Hacemos el logout
        Auth::logout();
        //Reseteamos la sesión
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        //Redirigimos al login
        return redirect(route("login"));
    }
}
