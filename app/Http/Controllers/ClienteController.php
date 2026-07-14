<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreclienteRequest;
use App\Http\Requests\UpdateclienteRequest;
use App\Models\cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = cliente::paginate(10);
        return view('cliente.index',[
            'clientes' => $clientes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //session()->flash('success', 'Cliente actualizado correctamente');
        return view('cliente.create');
        //dd('Creando al cliente');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request)
    {
        //dd('Cliente por ser registrado');
        $cliente = Cliente::create(request()->all());

        if ($request->wantsJson()) {
            return response()->json(['cliente' => $cliente], 201);
        }

        session()->flash('success', 'Cliente añadido exitosamente');
        return redirect()->route('clientes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cliente $cliente)
    {
        return view('cliente.edit',[
            'cliente' => $cliente
        ]);
        //dd('Editando al cliente');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateclienteRequest $request, cliente $cliente)
    {
        $cliente->update(request()->all());
        session()->flash('success', 'Cliente actualizado exitosamente');
        return redirect()->route('clientes.index');
        //dd('Actualizando al cliente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cliente $cliente)
    {
        //dd('Eliminando al cliente...' . $cliente->id);
        $cliente->delete();
        return redirect()->route('clientes.index');
    }
}
