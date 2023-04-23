<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProveedoresRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'clave'     => 'required|min:3|max:10|regex:/^[a-zA-Z0-9]+$/|unique:proveedores,clave,'.$this->id,
            'empresa'   => 'nullable|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
        ];
    }
    public function messages()
    {
        return [
            'clave.required'        => 'Escribe alguna clave',
            'clave.min'             => 'La clave debe tener mínimo 3 caracteres',
            'clave.max'             => 'La clave debe tener máximo 10 caracteres',
            'clave.regex'           => 'La clave debe ser letras o numeros sin caracteres especiales',
            'clave.unique'          => 'La clave ya existe',
            'empresa.min'           => 'La empresa debe tener mínimo 3 caracteres',
            'empresa.max'           => 'La empresa debe tener máximo 50 caracteres',
            'empresa.regex'         => 'La empresa debe ser letras sin caracteres especiales',
        ];
    }
}
