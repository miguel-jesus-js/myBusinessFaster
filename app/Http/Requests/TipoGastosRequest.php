<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoGastosRequest extends FormRequest
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
            'tipo' => 'required|min:3|max:50|regex:/^[\pL\s]+$/u',
        ];
    }

    public function messages()
    {
        return [
            'tipo.required' => 'Escribe alguna tipo de gasto',
            'tipo.min'      => 'El tipo de gasto debe tener mínimo 3 caracteres',
            'tipo.max'      => 'El tipo de gasto debe tener máximo 50 caracteres',
            'tipo.regex'    => 'El tipo de gasto debe ser letras sin caracteres especiales',
        ];
    }
}
