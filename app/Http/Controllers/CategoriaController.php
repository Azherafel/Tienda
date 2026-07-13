<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecategoriaRequest;
use App\Http\Requests\UpdatecategoriaRequest;
use App\Models\categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = categoria::paginate(10);
        return view('categoria.index',[
            'categorias' => $categorias
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecategoriaRequest $request)
    {
        categoria::create(request()->all());
        session()->flash('success', 'Categoria añadida exitosamente');
        return redirect()->route('categorias.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(categoria $categoria)
    {
        return view('categoria.edit', [
            'categoria' => $categoria
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecategoriaRequest $request, categoria $categoria)
    {
        $categoria->update(request()->all());
        session()->flash('success', 'Categoria actualizada correctamente');
        return redirect()->route('categorias.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(categoria $categoria)
    {
        $categoria->delete();
        session()->flash('success', 'Categoria eliminada correctamente');
        return redirect()->route('categorias.index');
    }
}
