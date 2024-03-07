@extends('app') <!-- Extiende el layout 'app' -->

@section('content') <!-- Define una sección llamada 'content' que se insertará en el layout 'app' -->
    <div class="container w-25 border p-4 my"> <!-- Contenedor con clases de Bootstrap -->
        <div class="row mx-auto"> <!-- Fila con clases de Bootstrap para centrar el contenido horizontalmente -->
            <form action="{{ route('categories.store') }}" method="POST"> <!-- Formulario que enviará los datos a la ruta 'categories.store' mediante el método POST -->
                @csrf <!-- Directiva de Blade para incluir el token CSRF -->
        
                @if (session('success')) <!-- Verifica si hay un mensaje de éxito en la sesión -->
                    <h6 class="alert alert-success">{{ session('success') }}</h6> <!-- Muestra un mensaje de éxito utilizando la clase de alerta de Bootstrap -->
                @endif <!-- Fin de la verificación de éxito -->
                
                @error('name') <!-- Verifica si hay errores en el campo 'name' -->
                    <h6 class="alert alert-danger">{{ $message }}</h6> <!-- Muestra el mensaje de error asociado al campo 'name' -->
                @enderror <!-- Fin de la verificación de errores en el campo 'name' -->
                
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre de la categoria</label> <!-- Etiqueta para el campo de entrada de texto para el nombre de la categoría -->
                    <input type="text" name="name" class="form-control" > <!-- Campo de entrada de texto para el nombre de la categoría -->
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">Color de la categoria</label> <!-- Etiqueta para el campo de selección de color -->
                    <input type="color" name="color" class="form-control" > <!-- Campo de selección de color -->
                </div>
        
                <button type="submit" class="btn btn-primary">Crear nueva categoria</button> <!-- Botón para enviar el formulario -->
            </form>

            <div> 
                @foreach ($categories as $category) <!-- Itera sobre cada categoría en la variable $categories -->
                    <div class="row py-1"> <!-- Inicia una fila con un pequeño espacio vertical -->
                        <div class="cold-md-9 d-flex align-items-center"> <!-- Inicia una columna para mostrar el nombre de la categoría -->
                            <a class="d-flex align-items-center gap-2" href="{{ route('categories.show', ['category' => $category->id])}}"> <!-- Enlace para mostrar los detalles de la categoría -->
                                <span class="color-container" style="background-color: {{ $category->color}} "></span> {{ $category->name }} <!-- Muestra el color y el nombre de la categoría -->
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-md-3 d-flex justify-content-end"> <!-- Inicia una columna para mostrar el botón de eliminar -->
                        <button class="btn btn-danger btn-sm" data-bs-toggle="#modal{{ $category->id}}">Eliminar</button> <!-- Botón para eliminar la categoría -->
                    </div>
                @endforeach
            </div>         
    </div>
@endsection <!-- Fin de la sección 'content' -->
