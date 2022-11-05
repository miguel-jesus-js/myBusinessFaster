<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoClientesRequest extends FormRequest
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
            'tipo_cliente' => 'required|min:3|max:30|regex:/^[\pL\s]+$/u'
        ];
    }

    public function messages()
    {
        return [
            'tipo_cliente.required' => 'Escribe algún tipo de cliente',
            'tipo_cliente.min' => 'El tipo de cliente debe tener mínimo 3 caracteres',
            'tipo_cliente.max' => 'El tipo de cliente debe tener máximo 30 caracteres',
            'tipo_cliente.regex' => 'El tipo de cliente debe ser letras sin caracteres especiales',
        ];
    }
}
