<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\EntradaController;

Route::view("/", "content")->middleware("auth")->name("contenido");
Route::view("/login", "login")->name("login");
Route::view("/registro", "registration")->name("registro");

Route::get("/logout", [LoginController::class, "logout"])->name("logout");

Route::post("/validar-registro", [LoginController::class, "registration"])->name("validar-registro");
Route::post("/iniciar-sesion", [LoginController::class, "login"])->name("iniciar-sesion");

//Todas las rutas de las entradas
Route::middleware('auth')->group(function () { //Solo para usuarios autenticados
    Route::resource('entradas', EntradaController::class);
});

//Todas las rutas de las especies
Route::middleware('auth')->group(function () { //Solo para usuarios autenticados
    Route::resource('especies', EspecieController::class);
});