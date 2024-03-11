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
            'title' => 'required|min:3', // El título es obligatorio y debe tener al menos 3 caracteres
            'category_id' => 'nullable|exists:categories,id', // Validar que la categoría exista en la base de datos
        ]);

        // Crear una nueva instancia de Todo (modelo)
        $todo = new Todo;
        // Asignar el título de la tarea desde la solicitud
        $todo->title = $request->title;
        // Asignar la categoría de la tarea si se proporciona
        if ($request->has('category_id')) {
            $todo->category_id = $request->category_id;
        }
        // Guardar la nueva tarea en la base de datos
        $todo->save();
        // Redirigir a la ruta 'todos' y mostrar un mensaje de éxito
        return redirect()->route('todos')->with('success', 'Tarea creada correctamente');
    }

    // Método para mostrar todas las tareas en la vista 'todos.index'
    public function index(){
        // Cargar las tareas con la relación de categoría
        $todos = Todo::with('category')->get();
    
        // Obtener todas las categorías de la base de datos
        $categories = Category::all();
    
        // Retorna la vista 'todos.index' con todas las tareas y categorías
        return view('todos.index', ['todos' => $todos, 'categories' => $categories]);
    }

    public function show($id){
        // Obtener la tarea correspondiente al ID proporcionado junto con su relación de categoría
        $todo = Todo::with('category')->find($id);

        $categories = Category::all();

        $todo = Todo::find($id); // Obtiene la tarea correspondiente al ID proporcionado

        // Retorna la vista 'todos.show' pasando la tarea como parámetro
        return view('todos.show', ['todo' => $todo, 'categories' => $categories]);
        
    }

    public function update(Request $request, $id){
        // Buscar la tarea a actualizar utilizando su ID
        $todo = Todo::find($id);
        // Validar los datos de entrada
        $request->validate([
            'title' => 'required|min:3', // El título es obligatorio y debe tener al menos 3 caracteres
            'category_id' => 'nullable|exists:categories,id', // Validar que la categoría exista en la base de datos
        ]);
        // Actualizar el título de la tarea
        $todo->title = $request->input('title');
        // Actualizar la categoría de la tarea si se proporciona
        if ($request->has('category_id')) {
            $todo->category_id = $request->input('category_id');
        }
        // Guardar los cambios en la base de datos
        $todo->save();
        // Redirigir a la lista de tareas con un mensaje de éxito
        return redirect()->route('todos')->with('success', 'Tarea actualizada correctamente');
    }
    
    // Método para eliminar una tarea específica por su ID
    public function destroy($id){
        // Buscar la tarea utilizando su ID
        $todo = Todo::find($id);
        // Eliminar la tarea de la base de datos
        $todo->delete();
        // Redirigir a la lista de tareas con un mensaje de éxito
        return redirect()->route('todos')->with('success', 'La tarea ha sido eliminada correctamente');
    }
}
