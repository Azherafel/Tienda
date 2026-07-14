<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;

    protected $fillable = [
        'categoria_id',
        'nombreProducto',
        'descripcion',
        'precio',
        'stock',
        'imagen',
        'estado',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(categoria::class);
    }

    public function compraProductos(): HasMany
    {
        return $this->hasMany(CompraProducto::class);
    }

    protected function casts(): array
    {
        return [
            'precio' => 'decimal:2',
            'stock' => 'integer',
            'estado' => 'boolean',
        ];
    }
}
