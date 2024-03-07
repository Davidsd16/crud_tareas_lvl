<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{

    // Método para mostrar todas las categorías en la vista 'categories.index'
    public function index()
    {
        $categories = Category::all(); // Obtiene todas las categorías de la base de datos
        return view('categories.index', ['categories' => $categories]); // Retorna la vista 'categories.index' con todas las categorías
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
        return redirect()->route('categories.index')->with('success', 'Nueva categoria agregada');
    }

    // Método para mostrar los detalles de una categoría específica
    public function show(string $id)
    {
        $category = Category::find($id); // Busca la categoría utilizando su ID
        return view('categories.show', ['category' => $category]); // Retorna la vista 'categories.show' con los detalles de la categoría
    }

    // Método para actualizar una categoría existente
    public function update(Request $request, string $category)
    {
        $category = Category::find($category); // Busca la categoría a actualizar utilizando su ID
        $category->name = $request->name; // Actualiza el nombre de la categoría con el valor proporcionado en la solicitud
        $category->color = $request->color; // Actualiza el color de la categoría con el valor proporcionado en la solicitud
        $category->save(); // Guarda los cambios en la base de datos

        // Redirige a la ruta 'categories.index' con un mensaje de éxito
        return redirect()->route('categories.index')->with('success', 'Categoria actualizada');
    }

    // Método para eliminar una categoría existente
    public function destroy(string $category)
    {
        $category = Category::find($category); // Busca la categoría a eliminar utilizando su ID
        $category->delete(); // Elimina la categoría de la base de datos

        // Redirige a la ruta 'categories.index' con un mensaje de éxito
        return redirect()->route('categories.index')->with('success', 'Categoria eliminada');
    }

}
