@extends('layouts.app')
@section('title', 'Productos')
@section('content')


<div class="row">
    <div class="col-10">
        <br>
        <h1>Productos</h1>
    </div>

    @if (session('success'))
    @push('scripts')
    <script type="module">
        $(document).ready(function(){
            Swal.fire({
                icon: "success",
                title: "¡Listo!",
                text: "{{ session('success') }}"
            });
        });
    </script>
    @endpush
    @endif

    @push('scripts')
    <script type="module">
        $(document).ready(function(){
            $(".form-delete").submit(function(e){
                e.preventDefault();
                const form = this;
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "Esta acción no se puede deshacer.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Sí, eliminar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    @endpush
    <div class="col-2">
        <br><br><a class="btn btn-success" href="{{ route('productos.create') }}">Nuevo producto</a>
    </div>
</div>
<div class="row">
    <div class="col">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->nombreProducto }}</td>
                        <td>{{ $producto->categoria->nombreCategoria }}</td>
                        <td>${{ number_format($producto->precio, 2) }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>
                            @if ($producto->estado)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-secondary">Inactivo</span>
                            @endif
                        </td>
                        <td><a class="btn btn-primary"
                                href="{{ route('productos.edit', ['producto' => $producto->id]) }}">Actualizar</a></td>
                        <td>
                            <form action="{{ route('productos.destroy', ['producto' => $producto->id]) }}" method="POST" class="form-delete">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $productos->links() }}
    </div>
</div>
@endsection
