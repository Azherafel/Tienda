@extends('layouts.form')
@section('title', 'Editar categoria')

@section('form')
    <h2>Editar categoria</h2>
    <div class="shadow p-4 mb-5 bg-body-tertiary rounded">
        <form action="{{ route('categorias.update', ['categoria' => $categoria->id]) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="mb-4 fs-5">
                <label for="nombreCategoria" class="form-label">Nombre</label>
                <input name="nombreCategoria" type="text" class="form-control" id="nombreCategoria" placeholder="Nombre de la categoria" value="{{ old('nombreCategoria', $categoria->nombreCategoria) }}">
                @error('nombreCategoria')
                    <p class="text-danger small mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
