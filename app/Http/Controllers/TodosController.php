<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;

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
        $todo->category_id = $request->category_id; // ?? null;
        // Guardar la nueva tarea en la base de datos
        $todo->save();
        // Redirigir a la ruta 'todos' y mostrar un mensaje de éxito
        return redirect()->route('todos')->with('success', 'Tarea creada correctamente');
    }

    // Método para mostrar todas las tareas en la vista 'todos.index'
    public function index(){
        $todos = Todo::all(); // Obtiene todas las tareas de la base de datos
        $categories = Category::all(); // Obtiene todas las categorias de la base de datos
        return view('todos.index', ['todos' => $todos, 'categories' => $categories]); // Retorna la vista 'todos.index' con todas las tareas
    } 

    public function show($id){
        $todo = Todo::find($id); // Obtiene la tarea correspondiente al ID proporcionado
        return view('todos.show', ['todo' => $todo]); // Retorna la vista 'todos.show' pasando la tarea como parámetro
    }
    
    public function update(Request $request, $id){
        $todo = Todo::find($id); // Busca la tarea a actualizar utilizando su ID
        $todo->title = $request->input('title'); // Utiliza la sintaxis de flecha para acceder al valor del campo 'title' en la solicitud
        $todo->save(); // Guarda los cambios en la base de datos
        return redirect()->route('todos')->with('success', 'tarea actualizada!'); // Redirige a la lista de tareas con un mensaje de éxito
    }
    
    // Método para eliminar una tarea específica por su ID
    public function destroy($id){
        $todo = Todo::find($id); // Busca la tarea utilizando su ID
        $todo->delete(); // Elimina la tarea de la base de datos
        return redirect()->route('todos')->with('success', 'La tarea ha sido eliminada!'); // Redirige a la lista de tareas con un mensaje de éxito
    }

}

