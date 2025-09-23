<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\BajaController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas RESTful
Route::resource('usuarios', UsuarioController::class);
Route::resource('equipos', EquipoController::class);
Route::resource('departamentos', DepartamentoController::class);
Route::resource('bajas', BajaController::class);
