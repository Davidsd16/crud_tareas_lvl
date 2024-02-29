<?php

use App\Http\Controllers\TodosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tareas', function () { // Define una ruta GET para '/tareas'
    return view('todos.index'); // Retorna la vista 'todos.index'
})->name('todos'); // Asigna el nombre 'todos' a esta ruta

Route::post('/tareas', [TodosController::class, 'store'])->name('todos'); // Define una ruta POST para '/tareas' que apunta al método 'store' del controlador 'TodosController' y le asigna el nombre 'todos'

