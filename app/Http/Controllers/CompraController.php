<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompraRequest;
use App\Http\Requests\UpdateCompraRequest;
use App\Models\cliente;
use App\Models\Compra;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::with('cliente')->latest()->paginate(10);
        return view('compra.index', [
            'compras' => $compras
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = cliente::orderBy('nombre')->get();
        $productos = Producto::where('estado', true)->orderBy('nombreProducto')->get();
        return view('compra.create', [
            'clientes' => $clientes,
            'productos' => $productos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompraRequest $request)
    {
        DB::transaction(function () use ($request) {
            $compra = Compra::create([
                'cliente_id' => $request->cliente_id,
                'estado' => $request->estado,
                'metodoPago' => $request->metodoPago,
                'total' => 0,
            ]);

            $this->sincronizarProductos($compra, $request->productos);
        });

        session()->flash('success', 'Compra registrada exitosamente');
        return redirect()->route('compras.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Compra $compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $compra)
    {
        $compra->load('compraProductos.producto');
        $clientes = cliente::orderBy('nombre')->get();
        $productos = Producto::where('estado', true)
            ->orWhereIn('id', $compra->compraProductos->pluck('producto_id'))
            ->orderBy('nombreProducto')
            ->get();
        return view('compra.edit', [
            'compra' => $compra,
            'clientes' => $clientes,
            'productos' => $productos
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompraRequest $request, Compra $compra)
    {
        DB::transaction(function () use ($request, $compra) {
            $compra->update([
                'cliente_id' => $request->cliente_id,
                'estado' => $request->estado,
                'metodoPago' => $request->metodoPago,
            ]);

            $compra->compraProductos()->delete();
            $this->sincronizarProductos($compra, $request->productos);
        });

        session()->flash('success', 'Compra actualizada exitosamente');
        return redirect()->route('compras.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {
        $compra->delete();
        session()->flash('success', 'Compra eliminada correctamente');
        return redirect()->route('compras.index');
    }

    /**
     * Create the compra_productos rows for the given compra and update its total.
     */
    private function sincronizarProductos(Compra $compra, array $productos): void
    {
        $total = 0;

        foreach ($productos as $item) {
            $producto = Producto::findOrFail($item['producto_id']);
            $cantidad = (int) $item['cantidad'];
            $subtotal = $producto->precio * $cantidad;

            $compra->compraProductos()->create([
                'producto_id' => $producto->id,
                'cantidad' => $cantidad,
                'precioUnitario' => $producto->precio,
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        $compra->update(['total' => $total]);
    }
}
