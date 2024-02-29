@extends('app') <!-- Extiende el layout 'app' -->

@section('content') <!-- Define una sección llamada 'content' que se insertará en el layout 'app' -->

<div class="container w-25 border p-4 mt-4"> <!-- Contenedor con clases de Bootstrap -->
    <form action="{{ route('todos') }}" method="POST"> <!-- Formulario que enviará los datos a la ruta 'todos' mediante el método POST -->
        @csrf <!-- Directiva de Blade para incluir el token CSRF -->

        <div class="mb-3">
            <label for="title" class="form-label">Título de la tarea</label> <!-- Etiqueta para el campo de entrada de texto -->
            <input type="text" name="title" class="form-control" > <!-- Campo de entrada de texto para el título de la tarea -->
        </div>

        <button type="submit" class="btn btn-primary">Crear una nueva tarea</button> <!-- Botón para enviar el formulario -->
    </form>
</div>

@endsection <!-- Fin de la sección 'content' -->

