@extends('layouts.form')
@section('title', 'Crear categoria')

@section('form')
    <h2>Crear categoria</h2>
    <div class="shadow p-4 mb-5 bg-body-tertiary rounded">
        <form action="{{ route('categorias.store') }}" method="POST">
            @csrf
            <div class="mb-4 fs-5">
                <label for="nombreCategoria" class="form-label">Nombre</label>
                <input name="nombreCategoria" type="text" class="form-control" id="nombreCategoria" placeholder="Nombre de la categoria">
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>
@endsection
