<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreclienteRequest extends FormRequest
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
            'nombre.required' => '*El nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
            'nombre.max' => 'El campo nombre no debe exceder los 55 caracteres.',

            'apellidoP.required' => '*El apellido paterno es obligatorio.',
            'apellidoP.string' => 'El campo apellido paterno debe ser una cadena de texto.',
            'apellidoP.max' => 'El campo apellido paterno no debe exceder los 55 caracteres.',
            
            'apellidoM.required' => '*El apellido materno es obligatorio.',
            'apellidoM.string' => 'El campo apellido materno debe ser una cadena de texto.',
            'apellidoM.max' => 'El campo apellido materno no debe exceder los 55 caracteres.',
            
            'telefono.required' => '*El teléfono es obligatorio.',
            'telefono.digits' => 'El teléfono debe tener exactamente 10 dígitos.',
            
            'correo.required' => '*El correo es obligatorio.',
            'correo.string' => 'El campo correo debe ser una cadena de texto.',
            'correo.max' => 'El campo correo no debe exceder los 255 caracteres.',
            'correo.email' => 'El campo correo debe ser una dirección de correo válida.',
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
            'nombre' => 'required|string|max:55',
            'apellidoP' => 'required|string|max:55',
            'apellidoM' => 'required|string|max:55',
            'telefono' => 'required|digits:10',
            'correo' => 'required|string|max:255|email',
        ];
    }
}
