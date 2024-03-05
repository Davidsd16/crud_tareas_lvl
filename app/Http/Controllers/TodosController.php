<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo;

class TodosController extends Controller
{
    // Método para almacenar una nueva tarea
    public function store(Request $request){
        // Validar los datos de entrada
        $request->validate([
            'title' => 'required | min:3' // El título es obligatorio y debe tener al menos 3 caracteres
        ]);
        // Crear una nueva instancia de Todo (modelo)
        $todo = new Todo;
        // Asignar el título de la tarea desde la solicitud
        $todo->title = $request->title;
        // Guardar la nueva tarea en la base de datos
        $todo->save();
        // Redirigir a la ruta 'todos' y mostrar un mensaje de éxito
        return redirect()->route('todos')->with('success', 'Tarea creada correctamente');
    }

    // Método para mostrar todas las tareas en la vista 'todos.index'
    public function index(){
        $todos = Todo::all(); // Obtiene todas las tareas de la base de datos
        return view('todos.index', ['todos' => $todos]); // Retorna la vista 'todos.index' con todas las tareas
    } 
}
