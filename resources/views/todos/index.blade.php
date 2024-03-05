@extends('app') <!-- Extiende el layout 'app' -->

@section('content') <!-- Define una sección llamada 'content' que se insertará en el layout 'app' -->

<div class="container w-25 border p-4 mt-4"> <!-- Contenedor con clases de Bootstrap -->
    <form action="{{ route('todos') }}" method="POST"> <!-- Formulario que enviará los datos a la ruta 'todos' mediante el método POST -->
        @csrf <!-- Directiva de Blade para incluir el token CSRF -->

        @if (session('success')) <!-- Verifica si hay un mensaje de éxito en la sesión -->

            <h6 class="alert alert-success">{{ session('success') }}</h6> <!-- Muestra un mensaje de éxito utilizando la clase de alerta de Bootstrap -->
    
        @endif <!-- Fin de la verificación de éxito -->
        
        @error('title') <!-- Verifica si hay errores en el campo 'title' -->
        
            <h6 class="alert alert-danger">{{ $message }}</h6> <!-- Muestra el mensaje de error asociado al campo 'title' -->
        
        @enderror <!-- Fin de la verificación de errores en el campo 'title' -->
        <div class="mb-3">
            <label for="title" class="form-label">Título de la tarea</label> <!-- Etiqueta para el campo de entrada de texto -->
            <input type="text" name="title" class="form-control" > <!-- Campo de entrada de texto para el título de la tarea -->
        </div>

        <button type="submit" class="btn btn-primary">Crear una nueva tarea</button> <!-- Botón para enviar el formulario -->
    </form>
    <div>
        @foreach ($todos as $todo)
        <div class="row py-1">
            <div class="col-md-9 d-flex aling-items-center">
                <a href="{{ route('todos-edit', ['id' => $todo->id]) }}">{{ $todo->title}}</a> <!-- Enlace para editar la tarea -->
            </div>
    
            <div class="col-md-3 d-flex justin-content-end">
                <form action="{{ route('todos-destroy', ['id' => $todo->id]) }}" method="POST">
                    @method('DELETE') <!-- Método HTTP DELETE -->
                    @csrf <!-- Token CSRF -->
                    <button class="btn btn-danger btn-sm">Eliminar</button> <!-- Botón para eliminar la tarea -->
                </form>                
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection <!-- Fin de la sección 'content' -->

