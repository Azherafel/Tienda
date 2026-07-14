@extends('layouts.form')
@section('title', 'Crear producto')

@section('form')
    <h2>Crear producto</h2>
    <div class="shadow p-4 mb-5 bg-body-tertiary rounded">
        <form action="{{ route('productos.store') }}" method="POST">
            @csrf
            <div class="mb-4 fs-5">
                <label for="categoria_id" class="form-label">Categoría</label>
                <select name="categoria_id" class="form-select" id="categoria_id">
                    <option value="">Selecciona una categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombreCategoria }}</option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <p class="text-danger small mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4 fs-5">
                <label for="nombreProducto" class="form-label">Nombre</label>
                <input name="nombreProducto" type="text" class="form-control" id="nombreProducto" placeholder="Nombre del producto" value="{{ old('nombreProducto') }}">
                @error('nombreProducto')
                    <p class="text-danger small mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4 fs-5">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" id="descripcion" rows="3" placeholder="Descripción del producto">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="text-danger small mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4 fs-5">
                <label for="precio" class="form-label">Precio</label>
                <input name="precio" type="number" step="0.01" min="0" class="form-control" id="precio" placeholder="Precio" value="{{ old('precio') }}">
                @error('precio')
                    <p class="text-danger small mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4 fs-5">
                <label for="stock" class="form-label">Stock</label>
                <input name="stock" type="number" min="0" class="form-control" id="stock" placeholder="Stock" value="{{ old('stock') }}">
                @error('stock')
                    <p class="text-danger small mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4 fs-5 form-check">
                <input name="estado" type="checkbox" class="form-check-input" id="estado" value="1" {{ old('estado', true) ? 'checked' : '' }}>
                <label for="estado" class="form-check-label">Producto activo</label>
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>
@endsection
