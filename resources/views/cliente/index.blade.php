@extends('layouts.app')
@section('title', 'Clientes')
@section('content')
    

<div class="row">
    <div class="col-10">
        <br>
        <h1>Clientes</h1>
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
                        Swal.fire({
                            title: "¡Eliminado!",
                            text: "El cliente ha sido eliminado exitosamente.",
                            icon: "success"
                        }).then(() => {
                            form.submit();
                        });
                    }
                });
            });
        });
    </script>
    @endpush
    <div class="col-2">
        <br><br><a class="btn btn-success" href="{{ route('clientes.create') }}">Nuevo cliente</a>
    </div>
</div>
<div class="row">
    <div class="col">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido paterno</th>
                    <th>Apellido materno</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->apellidoP }}</td>
                        <td>{{ $cliente->apellidoM }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>{{ $cliente->correo }}</td>
                        <td><a class="btn btn-primary"
                                href="{{ route('clientes.edit', ['cliente' => $cliente->id]) }}">Actualizar</a></td>
                        <td>
                            <form id="frm-delete-{{ $cliente->id }}" action="{{ route('clientes.destroy', ['cliente' => $cliente->id]) }}" method="POST" class="form-delete">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                            <script type="module">
                                        $("#frm-delete-{{ $cliente->id }}").submit(function(e) {
                                            //alert('SUBMIT OK');
                                            e.preventDefault();

                                            //////////////////////////////auth
                                            Swal.fire({
                                                title: "Estas seguro?",
                                                text: "No se podra revertir!",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Si, borrar!"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    /*
                                                    Swal.fire({
                                                    title: "Deleted!",
                                                    text: "Your file has been deleted.",
                                                    icon: "success"
                                                    });
                                                    */
                                                    this.submit();
                                                }
                                            });

                                            /////////////////////////////auth

                                        }); //fin SUBMIT
                                    </script>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection
