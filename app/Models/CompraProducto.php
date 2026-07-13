<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompraProducto extends Model
{
    /** @use HasFactory<\Database\Factories\CompraProductoFactory> */
    use HasFactory;

    protected $table = 'compra_productos';

    protected $fillable = [
        'compra_id',
        'producto_id',
        'cantidad',
        'precioUnitario',
        'subtotal',
    ];

    public function compra(): BelongsTo
    {
        return $this->belongsTo(Compra::class);
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}
