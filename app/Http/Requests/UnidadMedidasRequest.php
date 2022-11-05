<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnidadMedidasRequest extends FormRequest
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
            'unidad_medida' => 'required|min:3|max:30|regex:/^[\pL\s]+$/u',
        ];
    }
    public function messages()
    {
        return [
            'unidad_medida.required' => 'Escribe alguna unidad de medida',
            'unidad_medida.min' => 'La unidad de medida debe tener mínimo 3 caracteres',
            'unidad_medida.max' => 'La unidad de medida debe tener máximo 30 caracteres',
            'unidad_medida.regex' => 'La unidad de medida debe ser letras sin caracteres especiales',
        ];
    }
}
