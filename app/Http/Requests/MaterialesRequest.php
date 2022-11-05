<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialesRequest extends FormRequest
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
            'material' => 'required|min:3|max:30|regex:/^[\pL\s]+$/u',
        ];
    }

    public function messages()
    {
        return [
            'material.required' => 'Escribe alguna material',
            'material.min' => 'El material debe tener mínimo 3 caracteres',
            'material.max' => 'El material debe tener máximo 30 caracteres',
            'material.regex' => 'El material debe ser letras sin caracteres especiales',
        ];
    }
}
