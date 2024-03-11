<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Todo;

// Modelo Category que representa una categoría en la base de datos.
class Category extends Model
{
    use HasFactory;

    // Relación uno a muchos: una categoría puede tener varios TODOS.
    public function todos(){
        return $this->hasMany(Todo::class);
    }
}
