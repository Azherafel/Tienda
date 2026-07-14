<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCompraRequest extends FormRequest
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
            'cliente_id.required' => '*El cliente es obligatorio.',
            'cliente_id.exists' => 'El cliente seleccionado no es válido.',

            'estado.required' => '*El estado es obligatorio.',
            'estado.in' => 'El estado seleccionado no es válido.',

            'metodoPago.string' => 'El método de pago debe ser una cadena de texto.',
            'metodoPago.max' => 'El método de pago no debe exceder los 55 caracteres.',

            'productos.required' => '*Debes agregar al menos un producto.',
            'productos.array' => 'Los productos no tienen un formato válido.',
            'productos.min' => '*Debes agregar al menos un producto.',

            'productos.*.producto_id.required' => 'Selecciona un producto en cada fila.',
            'productos.*.producto_id.exists' => 'Uno de los productos seleccionados no es válido.',
            'productos.*.cantidad.required' => 'Indica la cantidad de cada producto.',
            'productos.*.cantidad.integer' => 'La cantidad debe ser un número entero.',
            'productos.*.cantidad.min' => 'La cantidad debe ser al menos 1.',
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
            'cliente_id' => 'required|exists:clientes,id',
            'estado' => 'required|in:pendiente,pagada,cancelada,entregada',
            'metodoPago' => 'nullable|string|max:55',
            'productos' => 'required|array|min:1',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ];
    }
}
