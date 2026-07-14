<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {
        return [
            'categoria_id.required' => '*La categoría es obligatoria.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',

            'nombreProducto.required' => '*El nombre del producto es obligatorio.',
            'nombreProducto.string' => 'El campo nombre debe ser una cadena de texto.',
            'nombreProducto.max' => 'El campo nombre no debe exceder los 100 caracteres.',

            'descripcion.string' => 'El campo descripción debe ser una cadena de texto.',

            'precio.required' => '*El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un valor numérico.',
            'precio.min' => 'El precio no puede ser negativo.',

            'stock.required' => '*El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock no puede ser negativo.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'categoria_id' => 'required|exists:categorias,id',
            'nombreProducto' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ];
    }
}
