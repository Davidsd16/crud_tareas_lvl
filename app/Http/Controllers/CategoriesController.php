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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
