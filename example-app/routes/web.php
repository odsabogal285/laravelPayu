<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\HolaController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('client', ClientController::class); // Se crea de forma automatica varias rutas para aceder a los diferentes metodos de la clase

Route::get('/hola/{name}', HolaController::class);
