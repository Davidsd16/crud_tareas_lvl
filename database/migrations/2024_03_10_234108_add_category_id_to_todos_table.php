<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migración para agregar la columna 'category_id' a la tabla 'todos'.
return new class extends Migration
{

    public function up(): void
    {
        // Agrega la columna 'category_id' a la tabla 'todos'.
        Schema::table('todos', function (Blueprint $table) {
            $table->bigInteger('category_id')->unsigned(); // Define la columna 'category_id'.
            $table
                ->foreign('category_id') // Define la clave foránea 'category_id'.
                ->references('id') // Hace referencia a la columna 'id' en la tabla 'categories'.
                ->on('categories') // Tabla de referencia.
                ->after('title'); // Ubica la columna 'category_id' después de la columna 'title'.
        });
    }

    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
        
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
