<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatsController;

Route::view("/", "content")->middleware("auth")->name("contenido");
Route::view("/login", "login")->name("login");
Route::view("/registro", "registration")->name("registro");

Route::get("/cuenta/{param}", [UserController::class, "edit"])->name("users.edit");
Route::get("/especies/proponer", [EspecieController::class, "suggest"])->middleware("auth")->name("especies.suggest");
Route::get("/estadisticas", [StatsController::class, "index"])->middleware("auth")->name("estadisticas");
Route::get("/estadisticas/{param}", [StatsController::class, "show"])->middleware("auth")->name("estadisticas.show");

Route::post("/validar-registro", [LoginController::class, "registration"])->name("validar-registro");
Route::post("/iniciar-sesion", [LoginController::class, "login"])->name("iniciar-sesion");
Route::post("/logout", [LoginController::class, "logout"])->name("logout");
Route::post("/especies/proponer", [EspecieController::class, "sendsuggestion"])->middleware("auth")->name("especies.sendsuggestion");

Route::put("/cuenta/actualizar", [UserController::class, "update_data"])->middleware("auth")->name("users.updatedata");
Route::put("/cuenta/cambiar-contrasenia", [UserController::class, "update_password"])->middleware("auth")->name("users.updatepassword");

Route::delete("/cuenta/eliminar", [UserController::class, "destroy"])->middleware("auth")->name("users.destroy");

//Todas las rutas de las entradas
Route::middleware('auth')->group(function () { //Solo para usuarios autenticados
    Route::resource('entradas', EntradaController::class);
});

//Todas las rutas de las especies
Route::middleware('auth')->group(function () { //Solo para usuarios autenticados
    Route::resource('especies', EspecieController::class);
});