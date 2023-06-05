<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function func_login(Request $request)
    {
        // return $request->ip();
        //validar 
        $credenciales = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        if (!Auth::attempt($credenciales)) {
            return response()->json(["mensaje" => "no autenticado"], 401);
        }
        //guardar
        $user = Auth::user();
        $token = $user->createToken("auth_token")->plainTextToken;
        return response()->json([
            "token" => $token,
            "token_type" => "Bearer",
            "user" => $user
        ], 401);
        //return response()->json(["mensaje" => "usuario registrado"], 201);
    }

    public function func_register(Request $request)
    {

        // return $request->ip();
        //validar 
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required"
        ]);
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->save();
        //guardar
        return response()->json(["mensaje" => "usuario registrado"], 201);
    }
    public function func_mi_perfil(Request $request)
    {
        $user = Auth::user();
        return response()->json(["user" => $user], 200);
    }
    public function func_salir(Request $request)
    {
        $user = Auth::user()->tokens()->delete();
        return response()->json(["mensaje" => "sesion cerrada"], 200);
    }
}
