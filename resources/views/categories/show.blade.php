@extends('app')

@section('content')

<div class="container w-25 border p-4">
    <div class="row mx-auto">
        <!-- Formulario para actualizar la categoría -->
        <form method="POST" action="{{ route('categories.update',['category' => $category->id]) }}">
            @method('PATCH') <!-- Método HTTP para la actualización de la categoría -->
            @csrf <!-- Token CSRF para protección del formulario -->

            <div class="mb-3 col">
                <!-- Mostrar mensajes de error para el nombre de la categoría -->
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Mostrar mensajes de error para el color de la categoría -->
                @error('color')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- Mostrar mensaje de éxito al actualizar la categoría -->
                @if (session('success'))
                    <h6 class="alert alert-success">{{ session('success') }}</h6>
                @endif
                <!-- Etiqueta y campo de entrada para el nombre de la categoría -->
                <label for="exampleFormControlInput1" class="form-label">Nombre de la categoría</label>
                <input type="text" class="form-control mb-2" name="name" id="exampleFormControlInput1" placeholder="Ejemplo: Trabajo..." value="{{ $category->name }}">
                
                <!-- Etiqueta y campo de selección de color para la categoría -->
                <label for="exampleColorInput" class="form-label">Color de la categoría</label>
                <input type="color" class="form-control form-control-color" name="color" id="exampleColorInput" value="{{ $category->color }}" title="Choose your color">

                <!-- Botón para enviar el formulario de actualización -->
                <input type="submit" value="Actualizar Categoria" class="btn btn-primary my-2" />
            </div>
        </form>

        <!-- Lista de tareas asociadas a la categoría -->
        <div>
            @if ($category->todos->count() > 0)
            <!-- Si hay tareas asociadas a la categoría -->
            @foreach ($category->todos as $todo )
                <!-- Itera sobre cada tarea -->
                <div class="row py-1">
                    <div class="col-md-9 d-flex align-items-center">
                        <!-- Enlace para editar la tarea -->
                        <a  href="{{ route('todos-edit', ['id' => $todo->id]) }}">{{ $todo->title }}
                        </a>
                    </div>
        
                    <div class="col-md-3 d-flex justify-content-end">
                        <!-- Formulario para eliminar la tarea -->
                        <form action="{{ route('todos-destroy', [$todo->id]) }}" method="POST">
                            @method('DELETE') <!-- Método HTTP para la eliminación de la tarea -->
                            @csrf <!-- Token CSRF para protección del formulario -->
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach    
        @else
            <!-- Si no hay tareas asociadas a la categoría -->
            No hay tareas para esta categoría
        @endif
        
        </div>
    </div>
</div>
@endsection
