<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\EntradaController;

Route::view("/", "content")->middleware("auth")->name("contenido");
Route::view("/login", "login")->name("login");
Route::view("/registro", "registration")->name("registro");

Route::get("/logout", [LoginController::class, "logout"])->name("logout");
Route::get("/especies", [EspecieController::class, "index"])->middleware("auth")->name("especies.index");
Route::get("/entradas", [EntradaController::class, "index"])->middleware("auth")->name("entradas.index");
Route::get("/entradas/crear", [EntradaController::class, "create"])->middleware("auth")->name("entradas.create");
Route::get('/entradas/detalles/{param}', [EntradaController::class, "show"])->name('entradas.show');
Route::get('/entradas/editar/{param}', [EntradaController::class, "edit"])->name('entradas.edit');

Route::post("/validar-registro", [LoginController::class, "registration"])->name("validar-registro");
Route::post("/iniciar-sesion", [LoginController::class, "login"])->name("iniciar-sesion");
Route::post("/entradas/store", [EntradaController::class, "store"])->middleware("auth")->name("entradas.store");
Route::put('/entradas/update', [EntradaController::class, "update"])->middleware("auth")->name('entradas.update'); //FIXME
