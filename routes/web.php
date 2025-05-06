<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EspecieController;

Route::view("/", "content")->middleware("auth")->name("contenido");
Route::view("/login", "login")->name("login");
Route::view("/registro", "registration")->name("registro");
//Route::view("/especies", "especies.index")->middleware("auth")->name("especies.index");

Route::post("/validar-registro", [LoginController::class, "registration"])->name("validar-registro");
Route::post("/iniciar-sesion", [LoginController::class, "login"])->name("iniciar-sesion");

Route::get("/logout", [LoginController::class, "logout"])->name("logout");
Route::get("/especies", [EspecieController::class, "index"])->middleware("auth")->name("especies.index");
