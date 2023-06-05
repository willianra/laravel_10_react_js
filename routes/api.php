<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//agrupando todas  las rutas 
Route::prefix("v1/auth/")->group(function () {
    Route::post("login", [AuthController::class, "func_login"]);
    Route::post("registro", [AuthController::class, "func_register"]);

    Route::middleware('auth:sanctum')->group(function () {

        Route::get("perfil", [AuthController::class, "func_mi_perfil"]);
        Route::post("salir", [AuthController::class, "func_salir"]);
    });
});
// CATEGORIAS END POINT
Route::apiResource("/categoria",CategoriaController::class);
Route::apiResource("/usuario",UsuarioController::class);