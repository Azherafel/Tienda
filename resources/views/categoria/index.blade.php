@extends('layouts.app')
@section('title', 'Categorias')
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
        <h1>Categorias</h1>
    </div>

    <div class="col-2">
        <br><br><a class="btn btn-success" href="{{ route('categorias.create') }}">Nueva categoria</a>
    </div>
</div>
<div class="row">
    <div class="col">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td>{{ $categoria->nombreCategoria }}</td>
                        <td><a class="btn btn-primary"
                                href="{{ route('categorias.edit', ['categoria' => $categoria->id]) }}">Actualizar</a></td>
                        <td>
                            <form action="{{ route('categorias.destroy', ['categoria' => $categoria->id]) }}" method="POST">
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
