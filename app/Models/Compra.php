<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Compra extends Model
{
    /** @use HasFactory<\Database\Factories\CompraFactory> */
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'total',
        'estado',
        'metodoPago',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(cliente::class);
    }

    public function compraProductos(): HasMany
    {
        return $this->hasMany(CompraProducto::class);
    }

    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, 'compra_productos')
            ->withPivot(['cantidad', 'precioUnitario', 'subtotal'])
            ->withTimestamps();
    }
}
