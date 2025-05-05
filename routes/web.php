<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::view("/", "content")->middleware("auth")->name("contenido");
Route::view("/login", "login")->name("login");
Route::view("/registro", "registration")->name("registro");
Route::view("/especies", "especies")->middleware("auth")->name("especies");

Route::post("/validar-registro", [LoginController::class, "registration"])->name("validar-registro");
Route::post("/iniciar-sesion", [LoginController::class, "login"])->name("iniciar-sesion");
Route::get("/logout", [LoginController::class, "logout"])->name("logout");
