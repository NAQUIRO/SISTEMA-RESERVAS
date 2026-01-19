<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function funIngresar(Request $request)
    {
        // Lógica para el inicio de sesión
    }

    public function funRegistro(Request $request)
    {
        // validar
        $request->validate([
            "name"=>"required",
            "email"=>"required|email",
            "password"=>"required"
        ]);

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->save();

    }

    public function funPerfil(Request $request)
    {
        // Lógica para obtener el perfil del usuario autenticado
    }

    public function funSalir(Request $request)
    {
        // Lógica para cerrar sesión
    }
}
