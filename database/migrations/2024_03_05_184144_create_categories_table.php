<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Método para realizar las migraciones
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Define un campo de identificación único
            $table->string('name'); // Define un campo de tipo string para el nombre de la categoría
            $table->string('color'); // Define un campo de tipo string para el color de la categoría
            $table->timestamps(); // Añade automáticamente los campos 'created_at' y 'updated_at' para el registro de la fecha de creación y actualización
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
