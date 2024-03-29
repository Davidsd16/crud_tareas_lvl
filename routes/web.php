<?php

use App\Http\Controllers\CategoriesController;
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

 // Define una ruta POST para '/tareas' que apunta al método 'index' del controlador 'TodosController' y le asigna el nombre 'todos'
Route::get('/tareas', [TodosController::class, 'index'])->name('todos');

 // Define una ruta POST para '/tareas' que apunta al método 'store' del controlador 'TodosController' y le asigna el nombre 'todos'
Route::post('/tareas', [TodosController::class, 'store'])->name('todos');

// Define una ruta para mostrar una tarea específica en el controlador 'TodosController' utilizando el método 'show'
Route::get('/tareas/{id}', [TodosController::class, 'show'])->name('todos-edit');

// Define una ruta para actualizar una tarea específica en el controlador 'TodosController' utilizando el método 'update'
Route::patch('/tareas/{id}', [TodosController::class, 'update'])->name('todos-update');

// Define una ruta para eliminar una tarea específica en el controlador 'TodosController' utilizando el método 'destroy'
Route::delete('/tareas/{id}', [TodosController::class, 'destroy'])->name('todos-destroy');

Route::resource('categories', CategoriesController::class);

