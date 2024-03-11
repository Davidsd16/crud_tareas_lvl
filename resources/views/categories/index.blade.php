@extends('app') <!-- Extiende el layout 'app' -->

@section('content') <!-- Define una sección llamada 'content' que se insertará en el layout 'app' -->
    <div class="container w-25 border p-4 my"> <!-- Contenedor con clases de Bootstrap -->
        <div class="row mx-auto"> <!-- Fila con clases de Bootstrap para centrar el contenido horizontalmente -->
            <form action="{{ route('categories.store', ['category' => $category->id]) }}" method="POST"> <!-- Formulario que enviará los datos a la ruta 'categories.store' mediante el método POST -->
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

                <!-- Etiqueta y lista desplegable para seleccionar la categoría de la tarea -->
                <label for="category_id" class="form-label">Categoria de la tarea</label>
                <select name="category_id" class="form-select">
                    <!-- Itera sobre todas las categorías disponibles -->
                    @foreach ($categories as $category)
                        <!-- Genera una opción para cada categoría -->
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Crear nueva categoria</button> <!-- Botón para enviar el formulario -->
            </form>

            <div> 
                @foreach ($categories as $category)
                    <div class="row py-1">
                        <div class="cold-md-9 d-flex align-items-center">
                            <a class="d-flex align-items-center gap-2" href="{{ route('categories.show', ['category' => $category->id])}}">
                                <span class="color-container" style="background-color: {{ $category->color}} "></span> {{ $category->name }}
                            </a>
                        </div>
                        <div class="col-md-3 d-flex justify-content-end">
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-{{ $category->id}}">Eliminar</button>
                        </div>
                    </div>
            
                    <!-- Modal -->
                    <div class="modal fade" id="modal-{{ $category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Lea atentamente la advertencia</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Contenido del modal -->
                                    Al eliminar la categoria <strong>{{ $category->name}}</strong> se eliminaran todas las tareas asignadas
                                    ¿Estas seguro que desea eliminar la categoria <strong>{{ $category->name }}</strong>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Confirmar Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>         
    </div>
@endsection <!-- Fin de la sección 'content' -->
