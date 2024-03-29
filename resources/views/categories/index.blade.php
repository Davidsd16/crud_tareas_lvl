@extends('app') <!-- Extiende el layout 'app' -->

@section('content') <!-- Define una sección llamada 'content' que se insertará en el layout 'app' -->
    <div class="container w-25 border p-4 my"> <!-- Contenedor con clases de Bootstrap -->
        <div class="row mx-auto"> <!-- Fila con clases de Bootstrap para centrar el contenido horizontalmente -->
            <form  method="POST" action="{{route('categories.store')}}">
                @csrf
        
                <div class="mb-3 col">
        
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        
                @error('color')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        
                @if (session('success'))
                        <h6 class="alert alert-success">{{ session('success') }}</h6>
                @endif
        
                    <label for="exampleFormControlInput1" class="form-label">Nombre de la categoría</label>
                    <input type="text" class="form-control mb-2" name="name" id="exampleFormControlInput1" placeholder="">
                    
                    <label for="exampleColorInput" class="form-label">Color de la categoria</label>
                    <input type="color" class="form-control form-control-color" name="color" id="exampleColorInput" value="#563d7c" title="Choose your color">
        
                    <input type="submit" value="Crear nueva categoria" class="btn btn-primary my-2" />
                </div>
            </form>

            <div> 
                @foreach ($categories as $category)
                    <div class="row py-1">
                        <div class="col-md-9 d-flex align-items-center">
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
                                    Al eliminar la categoría <strong>{{ $category->name}}</strong> se eliminarán todas las tareas asignadas.
                                    ¿Estás seguro que deseas eliminar la categoría <strong>{{ $category->name }}</strong>?
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
    </div>
@endsection <!-- Fin de la sección 'content' -->
