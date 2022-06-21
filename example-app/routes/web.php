<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HolaController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('client', ClientController::class); // Se crea de forma automatica varias rutas para aceder a los diferentes metodos de la clase

Route::get('/hola/{name}', [HolaController::class, 'index' ]);

Route::get('categoria', [CategoryController::class, 'getCategoria']);
Route::get('categoria/{id}', [CategoryController::class, 'getCategoriaId']);
Route::post('/addCategoria', [CategoryController::class, 'insertCategoria']);
Route::put('/updateCategoria/{id}', [CategoryController::class, 'updateCategoria']);
Route::delete('deleteCategoria/{id}', [CategoryController::class, 'deleteCategoria']);
