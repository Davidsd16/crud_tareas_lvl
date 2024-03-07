<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rules\Unique;

class CategoriesController extends Controller
{

    // Método para mostrar todas las categorías en la vista 'categories.index'
    public function index()
    {
        $categories = Category::all(); // Obtiene todas las categorías de la base de datos
        return view('categories.index', ['categories' => $categories]); // Retorna la vista 'categories.index' con todas las categorías
    }

    public function create()
    {
        //
    }

// Método para almacenar una nueva categoría en la base de datos
public function store(Request $request)
{
    // Validar los datos de entrada
    $request->validate([
        'name' => 'required|unique:categories|max:255', // El nombre es obligatorio, único en la tabla 'categories' y tiene un máximo de 255 caracteres
        'color' => 'required|max:7' // El color es obligatorio y tiene un máximo de 7 caracteres
    ]);

    $category = new Category; // Crea una nueva instancia de la clase Category
    $category->name = $request->name; // Asigna el nombre de la categoría desde la solicitud
    $category->color = $request->color; // Asigna el color de la categoría desde la solicitud
    $category->save(); // Guarda la nueva categoría en la base de datos

    // Redirige a la ruta 'categories.index' con un mensaje de éxito
    return redirect()->route('categories.index')->with('success', 'Nueva categoría agregada');
}


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
