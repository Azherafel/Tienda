<?php

namespace App\Models;

use Database\Factories\ClienteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class cliente extends Model
{
    /** @use HasFactory<\Database\Factories\ClienteFactory> */
    use HasFactory;

    protected static function newFactory()
    {
        return ClienteFactory::new();
    }

    protected $fillable = [
        'nombre',
        'apellidoP',
        'apellidoM',
        'telefono',
        'correo'
    ];

    public function compras(): HasMany
    {
        return $this->hasMany(Compra::class);
    }
}
