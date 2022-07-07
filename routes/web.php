<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\PaymentAttemptController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/billing', [BillController::class, 'index'])->name('billing');
Route::get('/respuesta', [BillController::class, 'respuesta'])->name('respuesta');
//Route::post('/confirmacion', [BillController::class, 'confirmacion'])->name('confirmacion');
Route::post('/confirmacion', [PaymentAttemptController::class, 'confirmacion'])->name('confirmacion');
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
