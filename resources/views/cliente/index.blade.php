@extends('layouts.app')
@section('title', 'Clientes')
@section('content')

@section('alert')

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
    
@endsection

<div class="row">
    <div class="col-10">
        <br>
        <h1>Clientes</h1>
    </div>

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
                            <form action="{{ route('clientes.destroy', ['cliente' => $cliente->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
