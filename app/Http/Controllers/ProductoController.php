<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\categoria;
use App\Models\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::with('categoria')->paginate(10);
        return view('producto.index', [
            'productos' => $productos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = categoria::all();
        return view('producto.create', [
            'categorias' => $categorias
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request)
    {
        $data = $request->validated();
        $data['estado'] = $request->boolean('estado');
        Producto::create($data);
        session()->flash('success', 'Producto añadido exitosamente');
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        $categorias = categoria::all();
        return view('producto.edit', [
            'producto' => $producto,
            'categorias' => $categorias
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $data = $request->validated();
        $data['estado'] = $request->boolean('estado');
        $producto->update($data);
        session()->flash('success', 'Producto actualizado exitosamente');
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        session()->flash('success', 'Producto eliminado correctamente');
        return redirect()->route('productos.index');
    }
}
