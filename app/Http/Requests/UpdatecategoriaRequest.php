<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatecategoriaRequest extends FormRequest
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
            'nombreCategoria.required' => '*El nombre de la categoría es obligatorio.',
            'nombreCategoria.string' => 'El campo nombre de la categoría debe ser una cadena de texto.',
            'nombreCategoria.max' => 'El campo nombre de la categoría no debe exceder los 55 caracteres.',
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
            'nombreCategoria' => 'required|string|max:55',
        ];
    }
}
