@extends('layouts.form')
@section('title', 'Editar cliente')

@section('form')
    <h2>Editar cliente</h2>
    <div class="shadow p-4 mb-5 bg-body-tertiary rounded">
        <form action="{{ route('clientes.update', ['cliente' => $cliente->id]) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="mb-4 fs-5">
                <label for="nombre" class="form-label">Nombre</label>
                <input name="nombre" type="text" class="form-control" id="nombre" aria-describedby="emailHelp" placeholder="Nombre" value="{{ old('nombre', $cliente->nombre) }}">
                @error('nombre')
                    <p class="text-danger small mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4 fs-5">
                <label for="apellidoP" class="form-label">Apellido Paterno</label>
                <input name="apellidoP" type="text" class="form-control" id="apellidoP" aria-describedby="emailHelp" placeholder="Apellido Paterno" value="{{ old('apellidoP', $cliente->apellidoP) }}">
                @error('apellidoP')
                    <p class="text-danger small mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4 fs-5">
                <label for="apellidoM" class="form-label">Apellido Materno</label>
                <input name="apellidoM" type="text" class="form-control" id="apellidoM" aria-describedby="emailHelp" placeholder="Apellido Materno" value="{{ old('apellidoM', $cliente->apellidoM) }}">
                @error('apellidoM')
                    <p class="text-danger small mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4 fs-5">
                <label for="telefono" class="form-label">Teléfono</label>
                <input name="telefono" type="number" class="form-control" id="telefono" aria-describedby="emailHelp" placeholder="Teléfono" value="{{ old('telefono', $cliente->telefono) }}">
                @error('telefono')
                    <p class="text-danger small mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4 fs-5">
                <label for="correo" class="form-label">Email</label>
                <input name="correo" type="email" class="form-control" id="correo" aria-describedby="emailHelp" placeholder="Email" value="{{ old('correo', $cliente->correo) }}">
                @error('correo')
                    <p class="text-danger small mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
