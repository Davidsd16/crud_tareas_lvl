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
            $table->unsignedBigInteger('category_id')->default(1); // Define la columna 'category_id'.
            $table
                ->foreign('category_id') // Define la clave foránea 'category_id'.
                ->references('id') // Hace referencia a la columna 'id' en la tabla 'categories'.
                ->on('categories') // Tabla de referencia.
                ->after('title'); // Ubica la columna 'category_id' después de la columna 'title'.
        });

    }
    /**
     * Método down para revertir los cambios realizados en la migración.
     *
     * Revierte la eliminación de la clave foránea 'category_id' y la columna correspondiente en la tabla 'todos'.
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            // Elimina la clave foránea 'category_id' de la tabla 'todos'
            $table->dropForeign(['category_id']);
            
            // Elimina la columna 'category_id' de la tabla 'todos'
            $table->dropColumn('category_id');
        });
    }

};
